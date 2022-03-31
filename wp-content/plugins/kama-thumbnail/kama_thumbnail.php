<?php

/**
 * Plugin Name: Kama Thumbnail
 *
 * Description: Creates post thumbnails on fly and cache it. The Image for the thumbnail is taken from: WP post thumbnail / first img in post content / first post attachment img. To creat thumb for any img in post content add class "mini" to img and resize it in visual editor. In theme/plugin use functions: <code>kama_thumb_a_img()</code>, <code>kama_thumb_img()</code>, <code>kama_thumb_src()</code>.
 *
 * Text Domain: kama-thumbnail
 * Domain Path: languages
 *
 * Author: Kama
 * Plugin URI: https://wp-kama.ru/142
 *
 * Requires PHP: 5.6
 * Requires at least: 4.7
 *
 * Version: 3.3.7
 */

const KT_MAIN_FILE = __FILE__;

define( 'KT_PATH', wp_normalize_path( __DIR__ . '/' ) );

// as a plugin
if(
	false !== strpos( KT_PATH, wp_normalize_path( WP_PLUGIN_DIR ) )
	||
	false !== strpos( KT_PATH, wp_normalize_path( WPMU_PLUGIN_DIR ) )
){
	define( 'KT_URL', plugin_dir_url(__FILE__) );
}
// from the theme
else {
	define( 'KT_URL', strtr( KT_PATH, [ wp_normalize_path( get_template_directory() ) => get_template_directory_uri() ] ) );
}

require KT_PATH . 'class-Kama_Thumbnail__Admin.php';
require KT_PATH . 'class-Kama_Thumbnail__Clear_Cache.php';
require KT_PATH . 'class-Kama_Thumbnail.php';
require KT_PATH . 'class-Kama_Make_Thumb.php';
require KT_PATH . 'functions.php';


if( defined( 'WP_CLI' ) ){
	require KT_PATH . 'class-Kama_Thumb_CLI.php';
}

/**
 * Use following code instead of same-named functions where you want to show thumbnail:
 *
 *     echo apply_filters( 'kama_thumb_src', '', $args, $src );
 *     echo apply_filters( 'kama_thumb_img', '', $args, $src );
 *     echo apply_filters( 'kama_thumb_a_img', '', $args, $src );
 */
add_filter( 'kama_thumb_src', 'kama_thumb_hook_cb', 0, 3 );
add_filter( 'kama_thumb_img', 'kama_thumb_hook_cb', 0, 3 );
add_filter( 'kama_thumb_a_img', 'kama_thumb_hook_cb', 0, 3 );

/**
 * Initialize the plugin later, so that we can use some hooks from the theme.
 */
add_action( 'init', 'kama_thumbnail_init' );

function kama_thumbnail_init(){

	if( ! defined( 'DOING_AJAX' ) ){
		load_plugin_textdomain( 'kama-thumbnail', false, basename( KT_PATH ) . '/languages' );
	}

	Kama_Thumbnail::init();

	// upgrade
	if( defined( 'WP_CLI' ) || is_admin() || wp_doing_ajax() ){
		require_once __DIR__ .'/upgrade.php';

		Kama_Thumbnail\upgrade();
	}
}

