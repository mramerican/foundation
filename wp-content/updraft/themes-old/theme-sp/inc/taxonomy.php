<?php

/**
 * кастомный тип записи для ACF
 */
if (function_exists('acf_add_options_page')) {

  acf_add_options_page(array(
    //'page_title' => 'Основные настройки сайта',
    'menu_title' => 'Основные настройки',
    'menu_slug' => 'theme-general-settings',
    //'capability' => 'edit_posts',
    //'redirect' => false
  ));

  acf_add_options_sub_page(array(
    'page_title' => 'Общие для всех страниц',
    'menu_title' => 'Общие',
    'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array(
    'page_title' => 'Настройки шапки',
    'menu_title' => 'Шапка сайта',
    'parent_slug' => 'theme-general-settings',
  ));

  acf_add_options_sub_page(array(
    'page_title' => 'Настройки подвала',
    'menu_title' => 'Подвал сайта',
    'parent_slug' => 'theme-general-settings',
  ));

}

add_action('admin_init', '_psAcfAddNewType');
function _psAcfAddNewType()
{
  add_filter('acf/location/rule_types', 'acf_location_rules_types');

  function acf_location_rules_types($choices)
  {

    $choices['Категории']['_spCats'] = 'Названия категории';

    return $choices;

  }

  add_filter('acf/location/rule_values/_spCats', 'acf_location_rule_values_spCats');

  function acf_location_rule_values_spCats($choices)
  {
    $terms = get_terms([
      'taxonomy'   => 'category',
      'hide_empty' => false,
    ]);

    if ($terms) {
      foreach ($terms as $term) {
        $choices[$term->term_id] = $term->name;
      }
    }
    return $choices;
  }


  add_filter('acf/location/rule_match/_spCats', 'asp_location_rules_match_spCats', 10, 3);
  function asp_location_rules_match_spCats($match, $rule, $options)
  {

    $screen = get_current_screen();
    if ($screen->base !== 'term' || $screen->id !== 'edit-category') {
      return $match;
    }
    $term_id = $_GET['tag_ID'];
    $select_term = $rule['value'];
    if ($rule['operator'] === '==') {
      $match = ($term_id == pll_get_term($select_term));
    } elseif ($rule['operator'] === '!=') {
      $match = ($term_id != pll_get_term($select_term));
    }
    return $match;
  }
}

/**
 * rename custom single
 */
add_filter('post_type_labels_post', 'rename_posts_labels');
function rename_posts_labels( $labels ){
  $new = array(
//    'name'                  => 'Продукция и статьи',
//    'singular_name'         => 'Продукция и статьи',
//    'add_new'               => 'Добавить статью',
//    'add_new_item'          => 'Добавить статью',
//    'edit_item'             => 'Редактировать статью',
//    'new_item'              => 'Новая статья',
//    'view_item'             => 'Просмотреть статью',
//    'search_items'          => 'Поиск статей',
//    'not_found'             => 'Статей не найдено.',
//    'not_found_in_trash'    => 'Статей в корзине не найдено.',
//    'parent_item_colon'     => '',
//    'all_items'             => 'Все статьи',
//    'archives'              => 'Архивы статей',
//    'insert_into_item'      => 'Вставить в статью',
//    'uploaded_to_this_item' => 'Загруженные для этой статьи',
//    'featured_image'        => 'Миниатюра статьи',
//    'filter_items_list'     => 'Фильтровать список статей',
//    'items_list_navigation' => 'Навигация по списку статей',
//    'items_list'            => 'Список статей',
    'menu_name'             => 'Новини - Події - Програми',
//    'name_admin_bar'        => 'Статью', // пункте "добавить"
  );
  return (object) array_merge( (array) $labels, $new );
}