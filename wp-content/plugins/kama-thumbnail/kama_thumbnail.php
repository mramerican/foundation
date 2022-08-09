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
 * Version: 3.4.1
 */

const KTHUMB_MAIN_FILE = __FILE__;

define( 'KTHUMB_DIR', wp_normalize_path( __DIR__ ) );

// as plugin
if(
	false !== strpos( KTHUMB_DIR, wp_normalize_path( WP_PLUGIN_DIR ) )
	||
	false !== strpos( KTHUMB_DIR, wp_normalize_path( WPMU_PLUGIN_DIR ) )
){
	define( 'KTHUMB_URL', plugin_dir_url( __FILE__ ) );
}
// in theme
else {
	define( 'KTHUMB_URL', strtr( KTHUMB_DIR, [ wp_normalize_path( get_template_directory() ) => get_template_directory_uri() ] ) );
}


// load files

spl_autoload_register( static function( $name ){

	if( false !== strpos( $name, 'Kama_Make_Thumb' ) || false !== strpos( $name, 'Kama_Thumbnail' ) ){

		require KTHUMB_DIR . "/classes/$name.php";
	}
} );

require KTHUMB_DIR . '/functions.php';


// stop if this file loads from uninstall.php file
if( defined( 'WP_UNINSTALL_PLUGIN' ) ){
	return;
}

// init

if( defined( 'WP_CLI' ) ){

	WP_CLI::add_command( 'kthumb', 'Kama_Thumbnail_CLI_Command', [
		'shortdesc' => 'Kama Thumbnail CLI Commands',
	] );
}


/**
 * Initialize the plugin later, so that we can use some hooks from the theme.
 */
add_action( 'init', 'kama_thumbnail_init' );

function kama_thumbnail_init(){

	if( ! defined( 'DOING_AJAX' ) ){
		load_plugin_textdomain( 'kama-thumbnail', false, basename( KTHUMB_DIR ) . '/languages' );
	}

	Kama_Thumbnail::init();

	// upgrade
	if( defined( 'WP_CLI' ) || is_admin() || wp_doing_ajax() ){
		require_once __DIR__ .'/upgrade.php';

		\Kama_Thumbnail\upgrade();
	}
}

