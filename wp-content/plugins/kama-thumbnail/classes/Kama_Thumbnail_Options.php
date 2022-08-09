<?php

/**
 * @property-read string $meta_key
 * @property-read string $cache_dir
 * @property-read string $cache_dir_url
 * @property-read string $no_photo_url
 * @property-read string $use_in_content
 * @property-read bool   $no_stub
 * @property-read bool   $auto_clear
 * @property-read int    $auto_clear_days
 * @property-read bool   $rise_small
 * @property-read int    $quality
 * @property-read array  $allow_hosts
 * @property-read int    $stop_creation_sec
 * @property-read bool   $webp
 *
 * @property bool $debug
 *
 * @property-read string $opt_name
 * @property-read string $skip_setting_page
 */
class Kama_Thumbnail_Options {

	/**
	 * Current domain without www. and subdomains: www.foo.site.com → site.com
	 *
	 * @var string
	 */
	public static $main_host;

	/**
	 * Plugin options.
	 *
	 * {@see get_default_options()}
	 *
	 * @var object $opt {
	 *     Array of options.
	 *
	 *     @type string $meta_key          Name of the Meta field of the post.
	 *     @type string $cache_dir         Full path to the thumbnails' folder.
	 *     @type string $cache_dir_url     URL of the thumbnails' folder.
	 *     @type string $no_photo_url      URL of the stub file.
	 *     @type string $use_in_content    Whether to look for the images in post content with 'mini' css class to resize them.
	 *     @type bool   $no_stub           Whether to not display a stub image.
	 *     @type bool   $auto_clear        Whether to clear the cache every X days.
	 *     @type int    $auto_clear_days   Every X number of days to clear the cache.
	 *     @type bool   $rise_small        Zoom in a thumbnail (width/height) if its size is less than the specified size.
	 *     @type int    $quality           The quality of created thumbnails.
	 *     @type string $allow_hosts       Comma separated available hosts. Specify 'any' to allow any host.
	 *     @type int    $stop_creation_sec Max number of seconds for PHP to create thumbnails. The php process will be aborted
	 *                                     no mater is there thumbs for creation or not.
	 *     @type bool   $webp              Use webp format for thumbnails.
	 *     @type int    $debug             Debug mode (for developers).
	 * }
	 */
	private $opt;

	private static $default_options = [
		'meta_key'          => 'photo_URL',
		'cache_dir'         => '',
		'cache_dir_url'     => '',
		'no_photo_url'      => '',
		'use_in_content'    => 'mini',
		'no_stub'           => false,
		'auto_clear'        => false,
		'auto_clear_days'   => 7,
		'rise_small'        => true,
		'quality'           => 90,
		'allow_hosts'       => [],
		'stop_creation_sec' => 20,
		'webp'              => false,
		'debug'             => 0,
	];

	private static $setable_options = [
		'debug',
	];

	private $_opt_name = 'kama_thumbnail';

	/**
	 * @var bool
	 */
	private $_skip_setting_page;

	/**
	 * @var string[]
	 */
	private static $allowed_hosts = [ 'youtube.com', 'youtu.be' ];


	// methods

	public function __set( $name, $val ){

		if( in_array( $name, self::$setable_options, true ) ){
			$this->opt->$name = $val;
		}
	}

	public function __isset( $name ){
		return null !== $this->__get( $name );
	}

	public function __get( $name ){

		if( isset( $this->opt->$name ) ){
			return $this->opt->$name;
		}

		if( 'opt_name' === $name ){
			return $this->_opt_name;
		}

		if( 'skip_setting_page' === $name ){
			return $this->_skip_setting_page;
		}

		return null;
	}

	public function __construct(){

		$this->set_options();
	}

	public function init(){

		$this->set_main_host();
		$this->set_allow_hosts();
		$this->fill_empty();
	}

	private function set_options(){

		$this->_skip_setting_page = (bool) has_filter( 'kama_thumb__default_options' );

		if( $this->_skip_setting_page ){
			/**
			 * Allows to change default options.
			 * If this hook in use, the plugin options page is disables automatically.
			 */
			$options = apply_filters( 'kama_thumb__default_options', self::$default_options );
		}
		else{
			$options = array_merge( self::$default_options, $this->get_options_raw() );
		}

		$this->opt = (object) $options;

		// backcompat from v3.4.10
		if( ! is_array( $this->opt->allow_hosts ) ){
			$this->opt->allow_hosts = wp_parse_list( $this->opt->allow_hosts );
		}
	}

	/**
	 * Fill options that saved as empty to use default.
	 * Or options that need to be completed in runtime.
	 *
	 * @return void
	 */
	private function fill_empty(){

		if( ! $this->opt->no_photo_url ){
			$this->opt->no_photo_url = KTHUMB_URL . 'no_photo.jpg';
		}

		if( ! $this->opt->cache_dir ){
			$this->opt->cache_dir = untrailingslashit( str_replace( '\\', '/', WP_CONTENT_DIR . '/cache/thumb' ) );
		}

		if( ! $this->opt->cache_dir_url ){
			$this->opt->cache_dir_url = untrailingslashit( content_url() .'/cache/thumb' );
		}

	}

	private function set_main_host(){

		self::$main_host = Kama_Thumbnail_Helpers::parse_main_dom( get_option( 'home' ) );

		// re-set (for multisite)
		is_multisite() && add_action( 'switch_blog', function(){
			self::$main_host = Kama_Thumbnail_Helpers::parse_main_dom( get_option('home') );
		} );
	}

	private function set_allow_hosts(){

		/**
		 * Allows to add allowed hosts from where the images can be downloaded.
		 *
		 * @param string[] $allowed_hosts
		 */
		self::$allowed_hosts = apply_filters( 'kama_thumbnail__allowed_hosts', self::$allowed_hosts );

		self::$allowed_hosts[] = self::$main_host;

		$this->opt->allow_hosts = array_merge( $this->opt->allow_hosts, self::$allowed_hosts );

		foreach( $this->opt->allow_hosts as & $host ){
			$host = str_replace( 'www.', '', $host );
		}
		unset( $host );
	}

	public function get_default_options(){

		return self::$default_options;
	}

	public function get_options_raw(){

		return is_multisite() ? get_site_option( $this->opt_name, [] ) : get_option( $this->opt_name, [] );
	}

	public function update_options( $options ){

		$options = $this->sanitize_options( $options );

		return is_multisite()
			? update_site_option( $this->opt_name, $options )
			: update_option( $this->opt_name, $options );
	}

	/**
	 * Sanitize options.
	 *
	 * @param array $opts
	 *
	 * @return array
	 */
	public function sanitize_options( $opts ){

		$defopt = (object) $this->get_default_options();

		foreach( $opts as $key => & $val ){

			if( $key === 'allow_hosts' ){
				$ah = wp_parse_list( $val );

				foreach( $ah as & $host ){
					$host = sanitize_text_field( $host );
					$host = Kama_Thumbnail_Helpers::parse_main_dom( $host );
				}
				unset( $host );

				$val = array_unique( $ah );
			}
			elseif( $key === 'meta_key' && ! $val ){

				$val = $defopt->meta_key;
			}
			elseif( $key === 'stop_creation_sec' ){

				$maxtime = (int) ( ini_get( 'max_execution_time' ) * 0.95 ); // -5%
				$val = (float) $val;
				$val = ( $val > $maxtime || ! $val ) ? $maxtime : $val;
			}
			else{
				$val = sanitize_text_field( $val );
			}
		}

		return $opts;
	}

}