<?php

class Kama_Thumbnail_Helpers {

	/**
	 * Get main domain name from URL or Subdomain:
	 * foo.site.com > site.com | sub.site.co.uk > site.co.uk | sub.site.com.ua > site.com.ua
	 *
	 * @param string  $host  URL or Host like: site.ru, site1.site.ru, xn--n1ade.xn--p1ai
	 *
	 * @return string Main domain name.
	 */
	public static function parse_main_dom( $host ) {

		// URL passed OR port is specified (dom.site.ru:8080 > dom.site.ru) (59.120.54.215:8080 > 59.120.54.215)
		if( preg_match( '~/|:\d{2}~', $host ) ){
			$host = parse_url( $host, PHP_URL_HOST );
		}

		// for http://localhost/foo  OR  IP
		if( ! strpos( $host, '.' ) || filter_var( $host, FILTER_VALIDATE_IP ) ){
			return $host;
		}

		$host = preg_replace( '/^www\./', '', $host );

		// cirilic: .сайт, .онлайн, .дети, .ком, .орг, .рус, .укр, .москва, .испытание, .бг
		if( false !== strpos( $host, 'xn--' ) ){
			preg_match( '/xn--[^.]+\.xn--[^.]+$/', $host, $mm );
		}
		// other: foo.academy, regery.com.ua, site.ru, foo.bar.photography, bar.tema.agr.co, ps.w.org
		else{
			preg_match( '/[a-z0-9][a-z0-9\-]{1,63}\.(?:[a-z]{2,11}|[a-z]{1,3}\.[a-z]{2,3})$/i', $host, $mm );
		}

		$main_dom = $mm[0];

		/**
		 * Allows to fix parsed main domain.
		 *
		 * @param string $main_dom
		 */
		return apply_filters( 'kama_thumb__parse_main_dom', $main_dom, $host );
	}

	public static function show_message( $text = '', $type = 'updated' ){

		if( defined('WP_CLI') ){
			'error' === $type ? WP_CLI::error( $text ) : WP_CLI::success( $text );
		}
		else {
			add_action( 'admin_notices', function() use ( $text, $type ){
				echo '<div id="message" class="'. $type .' notice is-dismissible"><p>'. $text .'</p></div>';
			} );
		}

	}

}