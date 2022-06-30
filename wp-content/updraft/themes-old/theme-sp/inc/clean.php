<?php

add_filter( 'wpseo_canonical', '__return_false' );

add_filter( 'wpseo_robots', 'yoast_seo_robots_remove_search' );

function yoast_seo_robots_remove_search( $robots ) {
  if ( is_paged() || get_query_var('paged') >= 2) {
    return false;
  }
  return $robots;
}

/**
 * отключаем создание миниатюр файлов для указанных размеров
 */
function delete_intermediate_image_sizes($sizes)
{
  // размеры которые не нужно генерировать при загрузке
  return array_diff($sizes, array(
    'large',
    'medium_large',
    'medium',
    //'thumbnail', - нужен для админки
  ));
}

add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');

/**
 * Отключаем emoji
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
//add_filter( 'tiny_mce_plugins', array($this, 'disable_emojis_tinymce') );

/**
 * Отключаем REST API
 */
/*remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action('wp_head', 'rest_output_link_wp_head', 10, 0);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
remove_action('auth_cookie_malformed', 'rest_cookie_collect_status');
remove_action('auth_cookie_expired', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_username', 'rest_cookie_collect_status');
remove_action('auth_cookie_bad_hash', 'rest_cookie_collect_status');
remove_action('auth_cookie_valid', 'rest_cookie_collect_status');
remove_filter('rest_authentication_errors', 'rest_cookie_check_errors', 100);
//remove_action('init', 'rest_api_init');
remove_action('rest_api_init', 'rest_api_default_filters', 10, 1);
//remove_action('parse_request', 'rest_api_loaded');
//remove_action('rest_api_init', 'wp_oembed_register_route');
//remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_action('wp_head', 'wp_oembed_add_discovery_links');*/

/**
 * Удаляем meta generator
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

/**
 * Удаляем короткую ссылку
 */
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);

/**
 * Удаляем RSD, WLW ссылки, на главную, предыдущую, первую запись
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);

/**
 * Удаляем RSS ссылки
 */
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);

/**
 * Удаляем dns prefetch
 */
remove_action('wp_head', 'wp_resource_hints', 2);


/**
 * Удаляем стили для показа свежих комментариев
 */
function remove_recent_comments_style()
{
  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

add_action('widgets_init', 'remove_recent_comments_style');

/**
 * отключаем скрипт wp-ember для встройки видео с YouTube
 */
function my_deregister_scripts()
{
  wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'my_deregister_scripts');

//add_action('admin_menu', 'remove_admin_menu');
function remove_admin_menu() {
  remove_menu_page('options-general.php'); // Удаляем раздел Настройки
  remove_menu_page('tools.php'); // Инструменты
  remove_menu_page('users.php'); // Пользователи
  remove_menu_page('plugins.php'); // Плагины
  remove_menu_page('themes.php'); // Внешний вид
  remove_menu_page('edit.php'); // Посты блога
  //remove_menu_page('upload.php'); // Медиабиблиотека
  //remove_menu_page('edit.php?post_type=page'); // Страницы
  remove_menu_page('edit.php?post_type=acf-field-group'); // ACF
  //remove_menu_page('edit-comments.php'); // Комментарии
  //remove_menu_page('link-manager.php'); // Ссылки
  //remove_menu_page('wpcf7');   // Contact form 7
  //remove_menu_page('options-framework'); // Cherry Framework
}


/*
 * WordPress 5.6.1: Window Unload Error Fix
 */
add_action('admin_print_footer_scripts', 'wp_561_window_unload_error_fix');
function wp_561_window_unload_error_fix(){
  ?>
  <script>
    jQuery(document).ready(function($){

      // Check screen
      if(typeof window.wp.autosave === 'undefined')
        return;

      // Data Hack
      var initialCompareData = {
        post_title: $( '#title' ).val() || '',
        content: $( '#content' ).val() || '',
        excerpt: $( '#excerpt' ).val() || ''
      };

      var initialCompareString = window.wp.autosave.getCompareString(initialCompareData);

      // Fixed postChanged()
      window.wp.autosave.server.postChanged = function(){

        var changed = false;

        // If there are TinyMCE instances, loop through them.
        if ( window.tinymce ) {
          window.tinymce.each( [ 'content', 'excerpt' ], function( field ) {
            var editor = window.tinymce.get( field );

            if ( ! editor || editor.isHidden() ) {
              if ( ( $( '#' + field ).val() || '' ) !== initialCompareData[ field ] ) {
                changed = true;
                // Break.
                return false;
              }
            } else if ( editor.isDirty() ) {
              changed = true;
              return false;
            }
          } );

          if ( ( $( '#title' ).val() || '' ) !== initialCompareData.post_title ) {
            changed = true;
          }

          return changed;
        }

        return window.wp.autosave.getCompareString() !== initialCompareString;

      }
    });
  </script>
  <?php
}