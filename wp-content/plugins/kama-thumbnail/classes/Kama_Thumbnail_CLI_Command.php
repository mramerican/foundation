<?php
/**
 * @noinspection PhpUndefinedClassInspection
 */

class Kama_Thumbnail_CLI_Command extends WP_CLI_Command {

	public function __construct(){}

	/**
	 * Working with cache and removable data (post meta).
	 *
	 * ## OPTIONS
	 *
	 * <rm>
	 * : Removes cache.
	 *
	 * [--stubs]
	 * : Remove only stubs from cache. The same as not specify any params.
	 *
	 * [--thumbs]
	 * : Remove all created thumbnails.
	 *
	 * [--meta]
	 * : Remove past meta associated with this plugin.
	 *
	 * [--all]
	 * : Remove post meta and all cache.
	 *
	 * ## EXAMPLES
	 *
	 *     wp kthumb cache rm           # treats as `rm --stubs`
	 *     wp kthumb cache rm --stubs
	 *     wp kthumb cache rm --thumbs
	 *     wp kthumb cache rm --meta
	 *     wp kthumb cache rm --all
	 *
	 * @param array $args
	 * @param array $params
	 */
	public function cache( $args, $params ){

		// clear cache
		if( 'rm' === array_shift( $args ) ){

			$type = 'rm_stub_thumbs';
			isset( $params['all'] )    && $type = 'rm_all_data';
			isset( $params['thumbs'] ) && $type = 'rm_thumbs';
			isset( $params['meta'] )   && $type = 'rm_post_meta';

			kthumb_cache()->force_clear( $type );
		}

	}

}
