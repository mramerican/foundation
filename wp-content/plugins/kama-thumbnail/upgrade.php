<?php

namespace Kama_Thumbnail;

/**
 * Plugin Upgrade
 * Need initiated Democracy_Poll class.
 * Нужно вызывать на странице настроек плагина, чтобы не грузить лишний раз сервер.
 */
function upgrade(){
	$ver_key = 'kama_thumb_version';

	$cur_ver = get_file_data( KTHUMB_MAIN_FILE, [ 'Version' =>'Version' ] )['Version'];
	$old_ver = get_option( $ver_key );

	if( $old_ver === $cur_ver ){
		return;
	}

	update_option( $ver_key, $cur_ver );

	\Kama_Thumbnail::init();

	v339_cache_dir_rename();
}

// v 3.3.9
function v339_cache_dir_rename(){

	$opts = kthumb_opt()->get_options_raw();

	if( ! isset( $opts['cache_dir_url'] ) ){

		$opts['cache_dir'] = @ $opts['cache_folder'] ?: '';
		$opts['cache_dir_url'] = @ $opts['cache_folder_url'] ?: '';

		unset( $opts['cache_folder'], $opts['cache_folder_url'] );

		kthumb_opt()->update_options( $opts );
	}

}