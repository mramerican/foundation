<?php
/**
 * preload
 */
function setPreloadResource(){
  ?>
  <link rel="dns-prefetch" href="https://www.googletagmanager.com">
  <link rel="dns-prefetch" href="https://www.google-analytics.com">
  <link rel="dns-prefetch" href="https://www.cloudflare.com">
  <?php
  /*


  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Circe-Extra-Bold.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Circe-Bold.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Circe-Light.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Circe-Extra-Light.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Circe-Circe-Thin.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Parimatch-Bold.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Parimatch-Medium.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Parimatch-Regular.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Parimatch-Light.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preload" href="<?php bloginfo("template_directory"); ?>/fonts/Parimatch-Thin.woff" as="font"  type="font/woff" crossorigin="anonymous">
  <link rel="preconnect" href="https://www.cloudflare.com">
  <link rel="preconnect" href="https://www.googletagmanager.com/gtag/js?id=UA-202607010-1/">
  <link rel="preconnect" href="https://connect.facebook.net/en_US/fbevents.js/">
  <link rel="preconnect" href="https://www.googletagmanager.com/gtag/js?id=G-RF0BTK52E8&l=dataLayer&cx=c">
  <link rel="preconnect" href="https://www.google-analytics.com/analytics.js/">


  */
}

/**
 * enqueue scripts and styles.
 */
function add_footer_styles()
{
  //style
//  $time = microtime();
//  $ver = "1.5.".$time;
  $ver = "1.5.3";
  wp_enqueue_style('new-style', get_template_directory_uri() . '/css/main.css', '', $ver);

}

function theme_sp_scripts()
{
  //script
  wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.5.1.min.js', array(), '3.5.1', true);
  wp_enqueue_script('jquery');
  wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array(), 2.2, true);
}


//add_action('wp_head', 'setPreloadResource');
add_action('wp_enqueue_scripts', 'theme_sp_scripts');
add_action( 'get_footer', 'add_footer_styles' );

/**
 * add attributes
 */
function add_attributes_in_link($html, $handle)
{
  $html = str_replace("type='text/javascript'", '', $html);
  //script 'jquery' === $handle ||
  if ('main' === $handle) {
    return str_replace("src=", "defer src=", $html);
  }

  return $html;
}

if (!is_admin()) {
  add_filter('script_loader_tag', 'add_attributes_in_link', 10, 2);
}

add_action('admin_head', 'psMyCustomStyle');
function psMyCustomStyle() {
  print '<style>
#edittag {
    max-width: 2600px;
}
</style>';
}

// facicon admin
function admin_favicon() {
//  echo '<link href="'.bloginfo("template_directory").'/img/icon.png" rel="apple-touch-icon">';
  echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo("template_directory").'/img/favicon.svg" />';
}
add_action('admin_head', 'admin_favicon');

// Add the filter.
add_filter( 'pll_rel_hreflang_attributes', 'filter_pll_rel_hreflang_attributes', 10, 1 );

// Define the pll_rel_hreflang_attributes callback.
function filter_pll_rel_hreflang_attributes( $hreflangs ) {

  /*foreach ( $hreflangs as $lang => $url ) {
    if ( $lang === 'en' ) {
      printf( '<link rel="alternate" href="%s" hreflang="%s" /><!-- custom hreflang -->' . "\n", esc_url( $url ), esc_attr( 'en-GB' ) );
    }
  }
  return $hreflangs;*/

  return false;
}

class WPForceLowercaseURLs {
  /**
   * Initialize plugin
   */
  public static function init() {
    // If page is non-admin, force lowercase URLs
    if ( !is_admin() ) {
      add_action( 'init', array('WPForceLowercaseURLs', 'toLower') );
    }
  }
  /**
   * Changes the requested URL to lowercase and redirects if modified
   */
  public static function toLower() {

    // Grab requested URL
    $url = $_SERVER['REQUEST_URI'];
    $params = $_SERVER['QUERY_STRING'];

    // If URL contains a period, halt (likely contains a filename and filenames are case specific)
    if ( preg_match('/[\.]/', $url) ) {
      return;
    }
    // If URL contains a capital letter
    if ( preg_match('/[A-Z]/', $url) ) {
      // Convert URL to lowercase
      $lc_url = empty($params)
        ? strtolower($url)
        : strtolower(substr($url, 0, strrpos($url, '?'))).'?'.$params;

      // if url was modified, re-direct
      if ($lc_url !== $url) {

        // 301 redirect to new lowercase URL
        header('Location: '.$lc_url, TRUE, 301);
        exit();
      }
    }
  }
}
WPForceLowercaseURLs::init();


// Hiding the page of the author's archive page
if( ! is_admin() ){
  add_filter( 'pre_handle_404', 'remove_author_pages_page' );
  add_filter( 'author_link', 'remove_author_pages_link' );

  // set 404 status
  function remove_author_pages_page( $false ) {
    if ( is_author() ) {
      global $wp_query;
      $wp_query->set_404();
      status_header( 404 );
      nocache_headers();

      return true; // to break the hook
    }

    return $false;
  }

  // remove the link
  function remove_author_pages_link( $content ) {
    return home_url();
  }
}