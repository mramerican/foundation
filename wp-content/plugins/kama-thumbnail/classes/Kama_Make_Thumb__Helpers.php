<?php

trait Kama_Make_Thumb__Helpers {

	/**
	 * Получает ссылку на картинку из произвольного поля текущего поста
	 * или ищет ссылку в контенте поста и создает произвольное поле.
	 *
	 * Если в тексте картинка не нашлась, то в произвольное поле запишется заглушка `no_photo`.
	 *
	 * @return string
	 */
	public function get_src_from_postmeta() {
		global $post, $wpdb;

		$post_id = $this->post_id;

		if( ! $post_id ){
			$post_id = isset( $post->ID ) ? $post->ID : 0;
		}

		if( ! $post_id ){
			return '';
		}

		$src = get_post_meta( $post_id, kthumb_opt()->meta_key, true );

		if( $src ){
			return $src;
		}

		// maybe standard thumbnail
		if( $_thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true ) ){
			$src = wp_get_attachment_url( (int) $_thumbnail_id );
		}

		// получаем ссылку из контента
		if( ! $src ){
			$post_content = $this->post_id
				? $wpdb->get_var( "SELECT post_content FROM $wpdb->posts WHERE ID = " . (int) $this->post_id . " LIMIT 1" )
				: $post->post_content;

			$src = $this->_get_src_from_text( $post_content );
		}

		// получаем ссылку из вложений - первая картинка
		if( ! $src ){
			$attch_img = get_children( [
				'numberposts'    => 1,
				'post_mime_type' => 'image',
				'post_parent'    => $post_id,
				'post_type'      => 'attachment'
			] );

			if( $attch_img = array_shift( $attch_img ) ){
				$src = wp_get_attachment_url( $attch_img->ID );
			}
		}

		// The `no_photo` stub, to not have to check all the time
		if( ! $src ){
			$src = 'no_photo';
		}

		update_post_meta( $post_id, kthumb_opt()->meta_key, wp_slash($src) );

		return $src;
	}

	/**
	 * Looks for a URL to an image in the text and returns it.
	 *
	 * @param string $text
	 *
	 * @return mixed|string|void
	 */
	protected function _get_src_from_text( $text ){

		$allowed_hosts_patt = '';

		if( ! in_array( 'any', $this->allow_hosts, true ) ){
			$hosts_regex = implode( '|', array_map( 'preg_quote', $this->allow_hosts ) );
			$allowed_hosts_patt = '(?:www\.)?(?:'. $hosts_regex .')';
		}

		$hosts_patt = '(?:https?://'. $allowed_hosts_patt .'|/)';

		if(
			( false !== strpos( $text, 'src=') ) &&
			preg_match('~(?:<a[^>]+href=[\'"]([^>]+)[\'"][^>]*>)?<img[^>]+src=[\'"]\s*('. $hosts_patt .'.*?)[\'"]~i', $text, $match )
		){
			// Check the URL of the link
			$src = $match[1];
			if( ! preg_match( '~\.(jpe?g|png|gif|webp|bmp)(?:\?.+)?$~i', $src ) || ! $this->_is_allowed_host( $src ) ){
				// Check the URL of the image, if the URL of the link does not fit
				$src = $match[2];
				if( ! $this->_is_allowed_host( $src ) ){
					$src = '';
				}
			}

			return $src;
		}

		/**
		 * Allows to extend the 'find src in text' parser.
		 *
		 * @param string $src
		 */
		return apply_filters( 'kama_thumb__get_src_from_text', '', $text );
	}

	/**
	 * Checks that the image is from an allowed host.
	 *
	 * @param string $src
	 *
	 * @return bool|mixed|void
	 */
	protected function _is_allowed_host( $src ){

		/**
		 * Allow to make the URL allowed for creating thumb.
		 *
		 * @param bool   $allowed  Whether the url allowed. If `false` fallback to default check.
		 * @param string $src      Image URL to create thumb from.
		 * @param object $opt      Kama thumbnail options.
		 */
		$allowed = apply_filters( 'kama_thumb__is_allowed_host', false, $src, kthumb_opt() );

		if( $allowed ){
			return true;
		}

		if(
			( '/' === $src[0] && '/' !== $src[1] ) || // relative url
			in_array( 'any', $this->allow_hosts, true )
		){
			return true;
		}

		$host = Kama_Thumbnail_Helpers::parse_main_dom( $src );

		return $host && in_array( $host, $this->allow_hosts, true );
	}

	/**
	 * Corrects the specified URL: adds protocol, domain (for relative links), etc.
	 *
	 * @param string $src
	 *
	 * @return string
	 */
	protected static function _fix_src_protocol_domain( $src ){

		// URL without protocol: //site.ru/foo
		if( 0 === strpos( $src, '//' ) ){
			$src = ( is_ssl() ? 'https' : 'http' ) . ":$src";
		}
		// relative URL
		elseif( '/' === $src[0] ){
			$src = home_url( $src );
		}

		return $src;
	}

	/**
	 * Changes the passed thumbnail path/URL, making it the stub path.
	 *
	 * @param string $path_url Path/URL to the thumbnail file.
	 * @param string $type     What was passed path or url?
	 *
	 * @return string New Path/URL.
	 */
	protected function _change_to_stub( $path_url, $type ){

		$bname = basename( $path_url );

		$base = ( 'url' === $type )
			? kthumb_opt()->cache_dir_url
			: kthumb_opt()->cache_dir;

		return "$base/stub_$bname";
	}

	/**
	 * Checks if the specified directory exists, tries to create it if it does not.
	 *
	 * @return bool
	 */
	protected function _check_create_folder(){

		$path = dirname( $this->thumb_path );

		if( is_dir( $path ) ){
			return true;
		}

		return mkdir( $path, self::$CHMOD_DIR, true );
	}

}