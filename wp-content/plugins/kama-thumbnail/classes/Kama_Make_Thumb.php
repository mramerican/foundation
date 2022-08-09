<?php

/**
 * A class for creating a single thumbnail.
 */

class Kama_Make_Thumb {

	use Kama_Make_Thumb__Helpers;

	/** @var string */
	public $src;

	/** @var int */
	public $width;

	/** @var int */
	public $height;

	/** @var bool|array */
	public $crop;

	/** @var int|float */
	public $quality;

	/** @var int */
	public $post_id;

	/** @var bool */
	public $no_stub;

	/**
	 * Dummy image URL.
	 *
	 * @var string
	 */
	public $stub_url;

	/**
	 * Enlarge small images to the specified size.
	 *
	 * @since 3.6
	 *
	 * @var bool
	 */
	public $rise_small;

	/**
	 * List of allowed hosts for the thumbnail being created.
	 *
	 * @var array
	 */
	public $allow_hosts;

	/**
	 * Переданные аргументы после обработки. {@see Kama_Make_Thumb::set_args()}
	 *
	 * @var array
	 */
	public $args;

	/** @var string */
	public $thumb_path;

	/** @var string */
	public $thumb_url;

	/**
	 * Various data for debug.
	 *
	 * @var array
	 */
	public $metadata = [];

	/**
	 * Forcibly change the format.
	 *
	 * @var string
	 */
	public $force_format;

	/**
	 * Last instance to have access to the information like $width, $height etc.
	 *
	 * @var Kama_Make_Thumb
	 */
	public static $last_instance;

	/**
	 * Thumbs created per php request.
	 *
	 * @var int
	 */
	static $_thumbs_created = 0;

	/** @var int */
	static $CHMOD_DIR = 0755;

	/** @var int */
	static $CHMOD_FILE = 0644;

	/**
	 * It is set in the settings of the admin panel.
	 * Or in Options class.
	 *
	 * @var bool|null
	 */
	private static $debug;

	/**
	 * Kama_Make_Thumb constructor.
	 *
	 * @param array|string  $args {@see Kama_Make_Thumb::set_args()}
	 * @param string|int    $src  {@see Kama_Make_Thumb::set_args()}
	 */
	public function __construct( $args = array(), $src = 'notset' ){

		self::$last_instance = $this;

		defined( 'FS_CHMOD_DIR' )  && self::$CHMOD_DIR = FS_CHMOD_DIR;
		defined( 'FS_CHMOD_FILE' ) && self::$CHMOD_FILE = FS_CHMOD_FILE;

		self::$debug = kthumb_opt()->debug;

		$this->set_args( $args, $src );
	}

	/**
	 * Обработка параметров для создания миниатюр.
	 *
	 * @param array|string  $args {
	 *     Make Thumb arguments.
	 *
	 *     @type string|int     $src          See this method `$src` parameter.
	 *     @type string|int     $url          $src alias.
	 *     @type string|int     $link         $src alias.
	 *     @type string|int     $img          $src alias.
	 *     @type int            $width        Width of the thumbnail. If 0, it is proportional to $height.
	 *     @type int            $height       Height of the thumbnail. If 0, it's proportional to $width.
	 *     @type string         $wh           Alias for $width and $height. E.g. 500x350 | 500/350 | 500:350 etc...
	 *     @type int            $attach_id    The ID of the image (attachment) in the WordPress structure. This ID can also be specified
	 *                                        as a number in the `$src` parameter or in the second parameter of the `kama_thumb_*()` functions.
	 *                                        See {@see wp_get_attachment_url()}.
	 *     @type bool           $notcrop      Forcibly not crop thumbnail. Overwrites $crop parameter.
	 *     @type bool|string    $crop         To disable cropping, specify: 'false/0/no/none' or define
	 *                                        the $notcrop parameter. You can specify a string: 'right/bottom' or
	 *                                        'top', 'bottom', 'left', 'right', 'center' and any combination of these.
	 *                                        This will indicate the crop area:
	 *                                        - 'left', 'right' - for horizontal.
	 *                                        - 'top', 'bottom' - for vertical.
	 *                                        - 'center' - for both sides.
	 *                                        When one value is specified, the second will be the default.
	 *                                        Cropping makes no sense if one of the sides ($width or $height) is 0.
	 *                                        In that case, it will always be matched proportionally.
	 *                                        Default: 'center/center'.
	 *     @type string         $allow        Allowed hosts for this query (separated by spaces or commas).
	 *                                        Expands the global option `allow_hosts`.
	 *     @type int            $quality      The quality of the created thumbnail. Default: `quality` option.
	 *     @type int|WP_Post    $post_id      The ID or object of the post to work with.
	 *     @type int|WP_Post    $post         $post_id alias.
	 *     @type bool           $no_stub      Do not show a stub if there is one. Default: `no_stub` option.
	 *                                        If you specify `false/0`, the plugin option will be ignored and the stub will be shown!
	 *     @type bool           $yes_stub     Deprecated from v 3.3.8. Use `no_stub = 0` instead.
	 *     @type string         $force_format Output image format: jpg, png, gif, webp.
	 *                                        Default: '' or 'webp' if webp options is set.
	 *     @type string         $stub_url     URL of the stub image.
	 *     @type bool           $rise_small   Whether to enlarge the image if it is smaller than the specified sizes. Default: true.
	 *     @type string         $class        `<img>` tag class attr.
	 *     @type string         $style        `<img>` tag style attr.
	 *     @type string         $alt          `<img>` tag alt attr.
	 *     @type string         $title        `<img>` tag title attr.
	 *     @type string         $attr         `<img>` tag any attributes. This string passed as it is inside tag attributes.
	 *     @type string         $a_class      `<a>` tag class attr
	 *     @type string         $a_style      `<a>` tag style attr
	 *     @type string         $a_attr       `<a>` tag any attributes. This string passed as it is inside tag attributes.
	 *     @type string         $force_lib    Force lib to use. May be: 'gd', 'imagick', '' (default).
	 * }
	 *
	 * @param string|int $src  URL of the original image. If a number is specified, it will be passed to the $attach_id parameter.
	 *
	 * @return void
	 */
	protected function set_args( $args = [], $src = 'notset' ){

		$default_args = apply_filters( 'kama_thumb_default_args', [

			'notcrop'      => false,
			'no_stub'      => ! empty( kthumb_opt()->no_stub ),
			'yes_stub'     => false,

			'force_format' => kthumb_opt()->webp ? 'webp' : '',
			'stub_url'     => kthumb_opt()->no_photo_url,
			'allow'        => '',
			'width'        => 0,
			'height'       => 0,
			'wh'           => '',
			'attach_id'    => is_numeric( $src ) ? (int) $src : 0,
			'src'          => $src,
			'quality'      => kthumb_opt()->quality,
			'post_id'      => '',
			'rise_small'   => kthumb_opt()->rise_small,
			'crop'         => true,

			'sizes'        => '', // TODO
			'srcset'       => '', // TODO
			'data-src'     => '', // extra
			'data-srcset'  => '', // extra

			'class'        => 'aligncenter',
			'style'        => '',
			'alt'          => '',
			'title'        => '',
			'attr'         => '',

			// <a> specific
			'a_class'  => '',
			'a_style'  => '',
			'a_attr'   => '',
			'rel'      => '', // extra
			'target'   => '', // extra
			'download' => '', // extra

			'force_lib'    => '',
		] );

		$rg = $args;

		if( is_string( $args ) ){
			// parse_str() turns spaces into `_`. Ex: `notcrop &w=230` → `notcrop_` (not `notcrop`)
			$args = preg_replace( '/ +&/', '&', trim( $args ) );
			parse_str( $args, $rg );

			// fix isset
			foreach( [ 'no_stub', 'yes_stub', 'notcrop', 'rise_small' ] as $name ){
				// specify if isset only! to not overwrite defaults
				if( isset( $rg[ $name ] ) ){
					$rg[ $name ] = ! in_array( $rg[ $name ], [ 'no', '0' ], 1 );
				}
			}
		}

		$rg = array_merge( $default_args, $rg );

		// trim strings
		foreach( $rg as & $val ){
			is_string( $val ) && $val = trim( $val );
		}
		unset( $val );

		// parse wh 50x50 | 50X50 | 50 50 | 50-50 etc...
		if( $rg['wh'] ){
			list( $rg['width'], $rg['height'] ) = preg_split( '/\D+/', $rg['wh'] ) + [ 0, 0 ];
		}

		// aliases
		isset( $rg['w'] )           && $rg['width']   = $rg['w'];
		isset( $rg['h'] )           && $rg['height']  = $rg['h'];
		isset( $rg['q'] )           && $rg['quality'] = $rg['q'];
		isset( $rg['post'] )        && $rg['post_id'] = $rg['post'];
		is_object( $rg['post_id'] ) && $rg['post_id'] = $rg['post_id']->ID;
		isset( $rg['url'] )         && $rg['src']     = $rg['url'];
		isset( $rg['link'] )        && $rg['src']     = $rg['link'];
		isset( $rg['img'] )         && $rg['src']     = $rg['img'];

		// fixes
		if( $rg['attach_id'] && $atch_url = wp_get_attachment_url( $rg['attach_id'] ) ){
			$rg['src'] = $atch_url;
		}

		// when src = ''/null/false
		if( ! $rg['src'] ){
			$rg['src'] = 'no_photo';
		}
		elseif( 'notset' === $rg['src'] ){
			$rg['src'] = '';
		}

		// set class props
		$this->src        = (string) $rg['src'];
		$this->stub_url   = (string) $rg['stub_url'];
		$this->width      = (int)    $rg['width'];
		$this->height     = (int)    $rg['height'];
		$this->quality    = (int)    $rg['quality'];
		$this->post_id    = (int)    $rg['post_id'];
		$this->rise_small = (bool)   $rg['rise_small'];
		$this->no_stub    = $rg['yes_stub'] ? false : (bool) $rg['no_stub'];

		// force_format
		if( $rg['force_format'] ){

			$format = strtolower( sanitize_key( $rg['force_format'] ) );

			if( 'jpg' === $format )
				$format = 'jpeg';

			if( in_array( $format, [ 'jpeg', 'png', 'gif', 'webp' ], true ) )
				$this->force_format = $format;
		}

		// default thumb size
		if( ! $this->height && ! $this->width ){
			$this->width = $this->height = 100;
		}

		// crop
		$this->crop = $rg['notcrop'] ? false : $rg['crop'];

		if( in_array( $this->crop, [ 'no', 'none' ], 1 ) ){
			$this->crop = false;
		}

		// cropping doesn't make sense if one of the sides is 0 - it will always fit proportionally.
		if( ! $this->height || ! $this->width ){
			$this->crop = false;
		}

		if( $this->crop ){

			if( in_array( $this->crop, [ true, 1, '1' ], true ) ){
				$this->crop = [ 'center', 'center' ];
			}
			else {
				if( is_string( $this->crop ) ){
					$this->crop = preg_split( '~[/,:| -]~', $this->crop ); // top/right
				}

				$this->crop += [ 'center', 'center' ];

				// поправим если неправильно указаны оси...

				// xx
				if( in_array( $this->crop[0], [ 'top','bottom' ], true ) ){
					$this->crop = array_reverse( $this->crop );
				}
				// yy
				if( in_array( $this->crop[1], [ 'left','right' ], true ) ){
					$this->crop = array_reverse( $this->crop );
				}

				// убедимся, что все верно.
				if( ! in_array( $this->crop[0], [ 'left','center','right' ], true ) ) $this->crop[0] = 'center';
				if( ! in_array( $this->crop[1], [ 'top','center','bottom' ], true ) ) $this->crop[1] = 'center';
			}
		}

		// allow_hosts

		$this->allow_hosts = kthumb_opt()->allow_hosts;
		if( $rg['allow'] ){
			foreach( wp_parse_list( $rg['allow'] ) as $host ){
				$this->allow_hosts[] = ( $host === 'any' ) ? $host : Kama_Thumbnail_Helpers::parse_main_dom( $host );
			}
		}

		/**
		 * Allows to change arguments after it has been parsed.
		 *
		 * @param array           $rg
		 * @param Kama_Make_Thumb $instance
		 * @param array           $args
		 */
		$this->args = apply_filters( 'kama_thumb__set_args', $rg, $this, $args );
	}

	/**
	 * Creates a thumbnail and/or gets the thumbnail URL.
	 *
	 * @return string
	 */
	public function src(){
		$src = $this->do_thumbnail();

		return apply_filters( 'kama_thumb__src', $src, $this->args );
	}

	/**
	 * Gets the IMG thumbnail tag.
	 *
	 * @return string
	 */
	public function img(){

		if( ! $src = $this->src() )
			return '';

		$rg = & $this->args;

		if( ! $rg['alt'] && $rg['attach_id'] ){
			$rg['alt'] = get_post_meta( $rg['attach_id'], '_wp_attachment_image_alt', true );
		}

		if( ! $rg['alt'] && $rg['title'] ){
			$rg['alt'] = $rg['title'];
		}

		$attrs = [
			'src'     => $src,
			// width & height at this moment is always accurate!
			'width'   => $this->width ?: null,
			'height'  => $this->height ?: null,
			'alt'     => $rg['alt'] ? esc_attr( $rg['alt'] ) : '',
			'loading' => 'lazy',
			'class'   => $rg['class'] ? preg_replace( '/[^A-Za-z0-9 _-]/', '', $rg['class'] ) : '',
			'title'   => $rg['title'] ? esc_attr( $rg['title'] ) : '',
			'style'   => $rg['style'] ? str_replace( '"', "'", strip_tags( $rg['style'] ) ) : '',
			'attr'    => $rg['attr'] ?: '',
			'srcset'  => $rg['srcset'] ?: '',
			'sizes'   => $rg['sizes'] ?: '',
			'data-src'     => $rg['data-src'] ?: '',
			'data-srcset'  => $rg['data-srcset'] ?: '',
		];

		/**
		 * Allow change <img> tag all attributes before create the tag.
		 *
		 * @param array           $attrs <img> tag attributes.
		 * @param array           $rg    Initial data.
		 * @param Kama_Make_Thumb $this
		 */
		$attrs = apply_filters( 'kama_thumb__img_attrs', $attrs, $rg, $this );

		$implode_attrs = [];
		foreach( $attrs as $key => $val ){

			// skip empty attributes (except required for IMG)
			if( ! $val && ! in_array( $key, [ 'alt', 'src' ], 1 ) ){
				continue;
			}

			// pass as is
			if( 'attr' === $key ){
				$implode_attrs[] = $val;
			}
			// esc_url
			elseif( in_array( $key, [ 'src', 'data-src' ], true ) ){
				$implode_attrs[] = sprintf( "$key=\"%s\"", esc_url( $val ) );
			}
			// esc_url
			elseif( 'title' === $key ){
				$implode_attrs[] = sprintf( "$key=\"%s\"", esc_attr( $val ) );
			}
			// esc_attr
			else {
				$implode_attrs[] = "$key=\"$val\"";
			}
		}

		$out = '<img '. implode( ' ', $implode_attrs ) .'>';

		/**
		 * Allow change <img> tag ready string.
		 *
		 * @param string $out   <img> tag.
		 * @param array  $attrs <img> tag attributes.
		 * @param array  $rg    Initial data.
		 */
		return apply_filters( 'kama_thumb__img', $out, $attrs, $rg );
	}

	/**
	 * Получает IMG в A теге.
	 *
	 * @return string
	 */
	public function a_img(){

		if( ! $img = $this->img() ){
			return '';
		}

		$rg = &$this->args;

		$attrs = [
			'href'     => $this->src,
			'a_class'  => $rg['a_class'] ? preg_replace( '/[^A-Za-z0-9 _-]/', '', $rg['a_class'] ) : '',
			'a_style'  => $rg['a_style'] ? str_replace( '"', "'", strip_tags( $rg['a_style'] ) ) : '',
			'a_attr'   => $rg['a_attr'] ?: '',
			'rel'      => $rg['rel'] ?: '',
			'target'   => $rg['target'] ?: '',
			'download' => $rg['download'] ?: '',
		];

		/**
		 * Allow change <a> tag all attributes before create the tag.
		 *
		 * @param array           $attrs <a> tag attributes.
		 * @param array           $rg    Initial data.
		 * @param Kama_Make_Thumb $this
		 */
		$attrs = apply_filters( 'kama_thumb__a_img_attrs', $attrs, $rg, $this );

		$implode_attrs = [];
		foreach( $attrs as $key => $val ){

			// skip empty attributes
			if( ! $val ){
				continue;
			}

			// pass as is
			if( 'a_attr' === $key ){
				$implode_attrs[] = $val;
			}
			// esc_url
			elseif( 'href' === $key ){
				$implode_attrs[] = sprintf( "href=\"%s\"", esc_url( $val ) );
			}
			else {
				// remove `a_` prefix
				if( 'a_' === $key[0] . $key[1] ){
					$key = substr( $key, 2 );
				}

				$implode_attrs[] = "$key=\"$val\"";
			}
		}

		$out = '<a '. implode( ' ', $implode_attrs ) .'>'. $img .'</a>';

		/**
		 * Allow change <a><img></a> tag ready string.
		 *
		 * @param string $out   <a> tag.
		 * @param array  $attrs <a> tag attributes.
		 * @param array  $rg    Initial data.
		 */
		return apply_filters( 'kama_thumb__a_img', $out, $rg, $attrs );
	}

	/**
	 * Create thumbnail.
	 *
	 * @return null|false|string  Thumbnail URL or false.
	 */
	protected function do_thumbnail(){

		// the request was sent by this plugin, exit to avoid recursion:
		// is a request for an image that does not exist (404 page).
		if( isset( $_GET['kthumbloc'] ) ){
			return null;
		}

		if( ! $this->src ){
			$this->src = $this->get_src_from_postmeta();
		}

		if( ! $this->src ){
			trigger_error( 'DOING IT WRONG: Kama_Make_Thumb::$src or global $post not specified.' );
			return false;
		}

		// if it's stub image
		if( 'no_photo' === $this->src ){
			if( $this->no_stub ){
				return false;
			}

			$this->src = $this->stub_url;
		}

		// fix url
		// NOTE: $this->src = urldecode( $this->src ); - not necessary, it will decode it automatically
		$this->src = html_entity_decode( $this->src ); // 'sd&#96;asd.jpg' to 'sd`asd.jpg'

		/**
		 * Allows you to handle src and return it by interrupting further code execution.
		 *
		 * @param string          $src
		 * @param Kama_Make_Thumb $make_thumb
		 */
		if( $src = apply_filters( 'pre_do_thumbnail_src', '', $this ) ){
			return $src;
		}

		$name_data = $this->_file_name_data();

		// Something wrong with src
		if( ! $name_data ){
			return null;
		}

		// skip SVG
		if( ! $name_data->file_name ){
			return $this->src;
		}

		$this->thumb_path = kthumb_opt()->cache_dir     ."/$name_data->sub_dir/$name_data->file_name";
		$this->thumb_url  = kthumb_opt()->cache_dir_url ."/$name_data->sub_dir/$name_data->file_name";

		$thumb_url = $this->get_thumb_cache();

		if( false === $thumb_url ){
			$thumb_url = $this->create_thumb();
		}

		return $thumb_url;
	}

	/**
	 * @return bool|mixed|string False if cache not set.
	 *                           '' (Empty string) if no_stub, but cache exists.
	 *                           Image URL if cache found.
	 */
	protected function get_thumb_cache(){

		$this->metadata['cache'] = false;

		// dont cache on debug
		if( self::$debug ){
			return false;
		}

		$thumb_url = apply_filters_ref_array( 'cached_thumb_url', [ '', & $this ] );

		if( ! $thumb_url && file_exists( $this->thumb_path ) ){
			$thumb_url = $this->thumb_url;

			$this->metadata['cache'] = 'found';
		}

		// there's a stub, return it
		if( ! $thumb_url && file_exists( $stub_thumb_path = $this->_change_to_stub( $this->thumb_path, 'path' ) ) ){

			$this->thumb_path = $stub_thumb_path;
			$this->thumb_url = $this->_change_to_stub( $this->thumb_url, 'url' );

			$this->metadata['cache'] = 'stub';

			if( $this->no_stub ){
				return '';
			}

			$thumb_url = $this->thumb_url;
		}

		// Cache found.
		if( $thumb_url ){
			// Set/check original dimensions.
			$this->_checkset_width_height();

			return $thumb_url;
		}

		return false;
	}

	protected function create_thumb(){

		// STOP if execution time exceed
		if( microtime( true ) - $GLOBALS['timestart'] > kthumb_opt()->stop_creation_sec ){
			static $stop_error_shown;

			if( ! $stop_error_shown && $stop_error_shown = 1 ){

				trigger_error( sprintf(
					'Kama Thumb STOPED (time exceed). %d thumbs created.', self::$_thumbs_created
				) );
			}

			return $this->src;
		}

		if( ! $this->_check_create_folder() ){

			Kama_Thumbnail_Helpers::show_message(
				sprintf(
					__( 'Folder where thumbs will be created not exists. Create it manually: "s%"', 'kama-thumbnail' ),
					kthumb_opt()->cache_dir
				),
				'error'
			);

			return false;
		}

		if( ! $this->_is_allowed_host( $this->src ) ){
			$this->src = self::_fix_src_protocol_domain( $this->stub_url );
			$this->metadata['stub'] = 'stub: host not allowed';
		}

		$this->src = self::_fix_src_protocol_domain( $this->src );

		$img_string = $this->get_img_string();
		$size = $img_string ? $this->_image_size_from_string( $img_string ) : false;

		// stub
		// Если не удалось получить картинку: недоступный хост, файл пропал после переезда или еще чего.
		// То для указаного УРЛ будет создана миниатюра из заглушки `no_photo.jpg`.
		// Чтобы после появления файла, миниатюра создалась правильно, нужно очистить кэш картинки.
		if( ! $size || empty( $size['mime'] ) || false === strpos( $size['mime'], 'image' ) ){
			$this->metadata['stub'] = 'stub: URL not image';
			$this->src = self::_fix_src_protocol_domain( $this->stub_url );
			$img_string   = $this->get_img_string();
		}
		else {
			$this->metadata += [
				'mime'        => $size['mime'],
				'orig_width'  => $size[0],
				'orig_height' => $size[1],
			];
		}

		// Change the file name if it is a stub image
		if( ! empty( $this->metadata['stub'] ) ){
			$this->thumb_path = $this->_change_to_stub( $this->thumb_path, 'path' );
			$this->thumb_url = $this->_change_to_stub( $this->thumb_url, 'url' );
		}

		if( ! $img_string ){
			trigger_error( 'ERROR: Couldn`t get img data, even no_photo.' );
			return false;
		}

		// Create thumb
		$use_lib = strtolower( $this->args['force_lib'] );
		$use_lib || ( $use_lib = extension_loaded('imagick') ? 'imagick' : '' );
		$use_lib || ( $use_lib = extension_loaded('gd')      ? 'gd'      : '' );
		$this->metadata['lib'] = $use_lib; // before the call ->make_thumbnail____

		if( 'imagick' === $use_lib ){
			$done = $this->make_thumbnail_Imagick( $img_string );
		}
		elseif( 'gd' === $use_lib ){
			$done = $this->make_thumbnail_GD( $img_string );
		}
		// no lib
		else {
			trigger_error( 'ERROR: Kama_ There is no one of the Image libraries (GD or Imagick) installed on your server.' );
			$done = false;
		}

		if( $done ){
			// set/change the image size in the class properties, if necessary
			$this->_checkset_width_height();
		}
		else {
			$this->thumb_url = '';
		}

		// allow process created thumbnail, for example, to compress it.
		do_action( 'kama_thumb_created', $this->thumb_path, $this );

		self::$_thumbs_created++;

		if( $this->no_stub && ! empty( $this->metadata['stub'] ) ){
			return false;
		}

		return $this->thumb_url;
	}

	/**
	 * Core: Creates a thumbnail file based on the Imagick library
	 *
	 * @param string $img_string
	 *
	 * @return bool
	 */
	protected function make_thumbnail_Imagick( $img_string ){

		try {

			$image = new Imagick();

			$image->readImageBlob( $img_string );

			// Select the first frame to handle animated images properly
			if( is_callable( [ $image, 'setIteratorIndex' ] ) ){
				$image->setIteratorIndex( 0 );
			}

			// set the quality
			$format = $image->getImageFormat();
			if( in_array( $format, [ 'JPEG', 'JPG' ] ) ){
				$image->setImageCompression( Imagick::COMPRESSION_JPEG );
			}
			if( 'PNG' === $format ){
				$image->setOption( 'png:compression-level', $this->quality );
			}

			$image->setImageCompressionQuality( $this->quality );

			$origin_h = $image->getImageHeight();
			$origin_w = $image->getImageWidth();

			// get the coordinates to read from the original and the size of the new image
			list( $dx, $dy, $wsrc, $hsrc, $width, $height ) = $this->_resize_coordinates( $origin_w, $origin_h );

			// crop
			$image->cropImage( $wsrc, $hsrc, $dx, $dy );
			$image->setImagePage( $wsrc, $hsrc, 0, 0 );

			// strip out unneeded meta data
			$image->stripImage();

			// downsize to size
			$image->scaleImage( $width, $height );

			if( $this->force_format ){
				$image->setImageFormat( $this->force_format );
			}

			if( 'webp' === $this->force_format ){

				if( 0 ){
					$image->setBackgroundColor( new ImagickPixel('transparent') );
					$image->setImageFormat('webp');
					$image->setImageAlphaChannel( imagick::ALPHACHANNEL_ACTIVATE );
					$image->writeImage( $this->thumb_path );
				}
				else{
					$image->writeImage( 'webp:' . $this->thumb_path );
				}

				$this->metadata['thumb_format'] = 'WEBP';
            }
            else {

	            $image->writeImage( $this->thumb_path );

	            $this->metadata['thumb_format'] = $image->getImageFormat();
            }

			chmod( $this->thumb_path, self::$CHMOD_FILE );
			$image->clear();
			$image->destroy();

			return true;
		}
		catch( ImagickException $e ){

			trigger_error( 'ImagickException: '. $e->getMessage(), E_USER_NOTICE );

			// Let's try to create through GD. Example: https://ps.w.org/wpforms-lite/assets/screenshot-2.gif
			$this->metadata['lib'] = 'Imagick error. Force GD';

			return $this->make_thumbnail_GD( $img_string );
		}

	}

	/**
	 * Core: Creates a thumbnail file based on the GD library
	 *
	 * @param string $img_string
	 *
	 * @return bool
	 */
	protected function make_thumbnail_GD( $img_string ){

		$size = $this->_image_size_from_string( $img_string );

		// file has no parameters
		if( $size === false ){
			return false;
		}

		// Create a resource
		$image = @ imagecreatefromstring( $img_string );
		$isok = ( PHP_VERSION_ID >= 80000 ) ? ( $image instanceof GDImage ) : is_resource( $image );
		if( ! $isok ){
			return false;
		}

		list( $origin_w, $origin_h ) = $size;

		// get the coordinates to read from the original and the size of the new image
		list( $dx, $dy, $wsrc, $hsrc, $width, $height ) = $this->_resize_coordinates( $origin_w, $origin_h );

		// Canvas
		$thumb = imagecreatetruecolor( $width, $height );

		if( function_exists( 'imagealphablending' ) && function_exists( 'imagesavealpha' ) ){
			imagealphablending( $thumb, false ); // color and alpha pairing mode
			imagesavealpha( $thumb, true );      // flag that keeps a transparent channel
		}

		// turn on the smoothing function
		if( function_exists( 'imageantialias' ) ){
			imageantialias( $thumb, true );
		}

		// resize
		if( ! imagecopyresampled( $thumb, $image, 0, 0, $dx, $dy, $width, $height, $wsrc, $hsrc ) ){
			return false;
		}

		// save image
		$thumb_format = explode( '/', $size['mime'] )[1];
		if( $this->force_format ){
			$thumb_format = $this->force_format;
		}

		// convert from full colors to index colors, like original PNG.
		if( 'png' === $thumb_format && function_exists( 'imageistruecolor' ) && ! imageistruecolor( $thumb ) ){
			imagetruecolortopalette( $thumb, false, imagecolorstotal( $thumb ) );
		}

		// transparent
		if( 'gif' === $thumb_format ){
			$transparent = imagecolortransparent( $thumb, imagecolorallocate( $thumb, 0, 0, 0 ) );
			$_width = imagesx( $thumb );
			$_height = imagesy( $thumb );
			for( $x = 0; $x < $_width; $x++ ){
				for( $y = 0; $y < $_height; $y++ ){
					$pixel = imagecolorsforindex( $thumb, imagecolorat( $thumb, $x, $y ) );
					if( $pixel['alpha'] >= 64 ){
						imagesetpixel( $thumb, $x, $y, $transparent );
					}
				}
			}
		}

		// jpg / png / webp / gif
		$func_name = function_exists( "image$thumb_format" ) ? "image$thumb_format" : 'imagejpeg';

		$this->metadata['thumb_format'] = $func_name;

		// AVIF | BMP | GIF | JPG | PNG | WBMP | XPM | WEBP
		switch( $func_name ){
			case 'imagegif':
			case 'imagebmp':
				$func_name( $thumb, $this->thumb_path );
				break;
			case 'imagepng':
				$quality = floor( $this->quality / 10 );
				$func_name( $thumb, $this->thumb_path, $quality );
				break;
			// imageavif, imagejpeg
			default:
				$func_name( $thumb, $this->thumb_path, $this->quality );
		}

		chmod( $this->thumb_path, self::$CHMOD_FILE );
		imagedestroy( $image );
		imagedestroy( $thumb );

		return true;
	}

	/**
	 * Gets the image as a string of data by the specified URL of the image.
	 *
	 * @return string Image data or an empty string.
	 */
	protected function get_img_string(){

		$img_str = '';
		$img_url = $this->src;

		// Let's add a marker to the internal URL to avoid recursion when there is no image
		// and we get to the 404 page, where the same thumbnail is created again.
		// add_query_arg() cannot be used
		if( false !== strpos( $this->src, Kama_Thumbnail_Options::$main_host ) ){
			$img_url .= ( strpos( $this->src, '?' ) ? '&' : '?' ) . 'kthumbloc';
		}

		if( false === strpos( $img_url, 'http' ) && '//' !== substr( $img_url, 0, 2 ) ){
			die( 'ERROR: image url begins with not "http" or "//". The URL: ' . esc_html( $img_url ) );
		}

		// ABSPATH
		if( strpos( $img_url, $_SERVER['HTTP_HOST'] ) ){

			$this->metadata['request_type'] = 'ABSPATH';

			// site root. $_SERVER['DOCUMENT_ROOT'] could be wrong
			$root_path = ABSPATH;

			// maybe WP in sub dir?
			$root_parent = dirname( ABSPATH ) . '/';
			if( @ file_exists( $root_parent . 'wp-config.php' ) && ! file_exists( $root_parent . 'wp-settings.php' ) ){
				$root_path = $root_parent;
			}

			// skip query args
			$img_path = preg_replace( '~^https?://[^/]+/(.*?)([?].+)?$~', "$root_path\\1", $img_url );

			if( file_exists( $img_path ) ){
				$img_str = self::$debug ? file_get_contents( $img_path ) : @ file_get_contents( $img_path );
			}
		}

		/**
		 * Allows to disable http requests.
		 *
		 * @param bool $disable
		 */
		if( apply_filters( 'kama_thumb__disable_http', false ) ){
			return '';
		}

		// WP HTTP API
		if( ! $img_str && function_exists( 'wp_remote_get' ) ){
			$this->metadata['request_type'] = 'wp_remote_get';

			$response = wp_remote_get( $img_url );

			if( wp_remote_retrieve_response_code( $response ) === 200 ){
				$img_str = wp_remote_retrieve_body( $response );
			}
		}

		// file_get_contents
		if( ! $img_str && ini_get('allow_url_fopen') ){
			$this->metadata['request_type'] = 'file_get_contents';

			// try find 200 OK. it may be 301, 302 redirects. In 3** redirect first status will be 3** and next 200 ...
			$OK_200 = false;
			$headers = (array) @ get_headers( $img_url );
			foreach( $headers as $line ){
				if( false !== strpos( $line, '200 OK' ) ){
					$OK_200 = true;
					break;
				}
			}

			if( $OK_200 ){
				$img_str = file_get_contents( $img_url );
			}
		}

		// CURL
		if( ! $img_str && ( extension_loaded('curl') || function_exists('curl_version') ) ){
			$this->metadata['request_type'] = 'curl';

			$ch = curl_init();

			/** @noinspection CurlSslServerSpoofingInspection */
			curl_setopt_array( $ch, [
				CURLOPT_URL            => $img_url,
				CURLOPT_FOLLOWLOCATION => true,  // To make cURL follow a redirect
				CURLOPT_HEADER         => false,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => false, // accept any server certificate
			]);

			$img_str = curl_exec( $ch );

			//$errmsg = curl_error( $ch );
			$info = curl_getinfo( $ch );

			curl_close( $ch );

			if( @ $info['http_code'] !== 200 ){
				$img_str = '';
			}
		}

		// If the URL returned HTML code (for example page 404). Check the first
		// 400 characters only, because '<!DOCTYPE' can be in the metadata of the image
		$img_str_head = trim( substr( $img_str, 0, 400 ) );
		if( $img_str_head && preg_match( '~<!DOCTYPE|<html~', $img_str_head ) ){
			$this->metadata['img_str_error'] = 'HTML in img_str';
			$img_str = '';
		}

		// there is <script> in the metadata - a vulnerable image.
		if( false !== stripos( $img_str, '<script') ){
			trigger_error( 'The &lt;script&gt; found in image data URL: '. esc_html( $img_url ) );
			$img_str = '';
		}

		return $img_str;
	}

	/**
	 * Parse src and make thumb file name and other name data.
	 *
	 * @return object|null {
	 *     Object of data.
	 *
	 *     @type string $ext       File extension.
	 *     @type string $file_name Thumb File name.
	 *     @type string $sub_dir   Thumb File parent directory name.
	 * }
	 */
	protected function _file_name_data(){

		$srcpath = parse_url( $this->src, PHP_URL_PATH );

		// wrong URL
		if( ! $srcpath ){
			return null;
		}

		$data = new stdClass;

		$this->metadata['file_name'] = $data;

		if( preg_match( '~\.([a-z0-9]{2,4})$~i', $srcpath, $mm ) ){
			$data->ext = strtolower( $mm[1] );
		}
		elseif( preg_match( '~\.(jpe?g|png|gif|webp|avif|bmp|svg)~i', $srcpath, $mm ) ){
			$data->ext = strtolower( $mm[1] );
		}
		else{
			$data->ext = 'png';
		}

		// skip SVG
		if( 'svg' === $data->ext ){
			$data->file_name = false;
		}
		else {

			if( $this->force_format ){
				$data->ext = $this->force_format;
			}

			$data->suffix = '';
			if( ! $this->crop && ( $this->height && $this->width ) ){
				$data->suffix .= '_notcrop';
			}

			if( is_array( $this->crop ) && preg_match( '~top|bottom|left|right~', implode( '/', $this->crop ), $mm ) ){
				$data->suffix .= "_$mm[0]";
			}

			if( ! $this->rise_small ){
				$data->suffix .= '_notrise';
			}

			// We can't use `md5( $srcpath )` because the URL may be differs by query parameters.
			// cut off the domain and create a hash.
			$data->src_md5 = md5( preg_replace( '~^(https?:)?//[^/]+~', '', $this->src ) );

			$file_name = substr( $data->src_md5, -15 ) . "_{$this->width}x$this->height$data->suffix.$data->ext";
			$sub_dir   = substr( $data->src_md5, -2 );

			$data->file_name = apply_filters_ref_array( 'kama_thumb__make_file_name', [ $file_name, $data, & $this ] );
			$data->sub_dir   = apply_filters_ref_array( 'kama_thumb__file_sub_dir',   [ $sub_dir,   $data, & $this ] );
		}

		return $data;
	}

	/**
	 * Gets the real image size .
	 *
	 * @param string $img_data
	 *
	 * @return array|bool
	 */
	protected function _image_size_from_string( $img_data ){

		if( function_exists( 'getimagesizefromstring' ) )
			return getimagesizefromstring( $img_data );

		return getimagesize( 'data://application/octet-stream;base64,' . base64_encode( $img_data ) );
	}

	/**
	 * Gets the crop coordinates.
	 *
	 * @param int $origin_w Original width
	 * @param int $origin_h Original height
	 *
	 * @return array X and Y indent and how many pixels to read in height
	 *               and width from the source: $dx, $dy, $wsrc, $hsrc.
	 */
	protected function _resize_coordinates( $origin_w, $origin_h ){

		// If it is specified not to enlarge the image and it is smaller than the
		// specified size, we specify the maximum size - this is the size of the image itself.
		// It is important to specify global values, they are used in the IMG width and height attribute and maybe somewhere else.
		if( ! $this->rise_small ){
			if( $origin_w < $this->width )  $this->width  = $origin_w;
			if( $origin_h < $this->height ) $this->height = $origin_h;
		}

		$crop   = $this->crop;
		$width  = $this->width;
		$height = $this->height;

		// If we don't need to crop and both sides are specified,
		// then find the smaller corresponding side of the image and reset it to zero
		if( ! $crop && ( $width > 0 && $height > 0 ) ){
			( $width/$origin_w < $height/$origin_h )
				? $height = 0
				: $width = 0;
		}

		// If one of the sides is not specified, give it a proportional value
		if( ! $width ) 	$width  = round( $origin_w * ( $height / $origin_h ) );
		if( ! $height ) $height = round( $origin_h * ( $width / $origin_w ) );

		// determine the need to transform the size so that the smallest side fits in
		// if( $width < $origin_w || $height < $origin_h )
		$ratio = max( $width/$origin_w, $height/$origin_h );

		// Determine the cropping position
		$dx = $dy = 0;
		if( is_array( $crop ) ){

			$xx = $crop[0];
			$yy = $crop[1];

			// cut left and right
			if( $height/$origin_h > $width/$origin_w ){
				    if( $xx === 'center' ) $dx = round( ($origin_w - $width * ($origin_h/$height)) / 2 ); // отступ слева у источника
				elseif( $xx === 'left' )   $dx = 0;
				elseif( $xx === 'right' )  $dx = round( ($origin_w - $width * ($origin_h/$height)) ); // отступ слева у источника
			}
			// cut top and bottom
			else {
				    if( $yy === 'center' ) $dy = round( ( $origin_h - $height * ( $origin_w / $width ) ) / 2 );
				elseif( $yy === 'top' )    $dy = 0;
				elseif( $yy === 'bottom' ) $dy = round( ( $origin_h - $height * ( $origin_w / $width ) ) );
				// ( $height * $origin_w / $width ) / 2 * 6/10 - отступ сверху у источника
				// *6/10 - чтобы для вертикальных фоток отступ сверху был не половина а процентов 30
			}
		}

		$this->metadata['crop'] = is_array( $crop ) ? implode( '/', $crop ) : 'none';

		// How many pixels to read from the source
		$wsrc = round( $width/$ratio );
		$hsrc = round( $height/$ratio );

		return array( $dx, $dy, $wsrc, $hsrc, $width, $height );
	}

	/**
	 * Sets the class width or height properties if they are unknown or not exact (when `notcrop`).
	 * The data can be useful for adding to HTML.
	 *
	 * @return void
	 */
	protected function _checkset_width_height(){

		if( $this->width && $this->height && $this->crop )
			return;

		// getimagesize support webP from PHP 7.1
		// speed: 2 sec per 50 000 iterations (fast)
		list( $width, $height, $type, $attr ) = getimagesize( $this->thumb_path );

		// not cropped and therefore one of the sides will always be differs from the specified.
		if( ! $this->crop ){
			if( $width )  $this->width = $width;
			if( $height ) $this->height = $height;
		}
		// cropped, but one of the sides may not be specified, check and determine it if necessary
		else {
			if( ! $this->width )  $this->width  = $width;
			if( ! $this->height ) $this->height = $height;
		}
	}

}




