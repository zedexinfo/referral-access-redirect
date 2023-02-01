<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( "CrCookie" ) ) {
	class CrCookie {
		protected static $instance;
		protected $pageRedirect;
		protected $allowOrigin;
		protected $interval;
		protected $cookieExpiry;
		protected $redirectPage;
		protected $redirectMsg;
		protected $redirectMethod;

		public function __construct() {
			$this->allowOrigin    = get_option( 'access_page_option' );
			$this->pageRedirect   = get_option( 'redirect_page_option' );
			$this->cookieExpiry   = get_option( 'cookie_expiry_option' );
			$this->interval       = get_option( 'interval_timeout_option' );
			$this->redirectPage   = get_option( "unauthorised_access_url_option" );
			$this->redirectMsg    = get_option( "unauthorised_access_message_option" );
			$this->redirectMethod = get_option( 'redirect_method_option' );

			add_action( 'init', [ $this, 'set_cookie_and_redirect' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'addScript' ] );
		}

		public function addScript() {
			if ( $this->interval && $this->pageRedirect && $this->cookieExpiry && $this->allowOrigin ) {
				wp_enqueue_script( 'cookie_redirect', CR_JS_PATH . 'cookie_redirect.js', [], time(), true );
				wp_localize_script( 'cookie_redirect', 'cookie_object', array(
					'redirect_page'    => get_option( 'redirect_page_option' ),
					'interval_timeout' => get_option( 'interval_timeout_option' )
				) );
			}
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function set_cookie_and_redirect() {
//            $link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $cookie_name = "access_site";
            $cookie_value = "access_site";
            $url = wp_get_raw_referer();
            if (!isset($_COOKIE[$cookie_name])) {
                if (str_contains($this->allowOrigin, $url)) {
                    if (!isset($_COOKIE[$cookie_name])) {
                        setcookie($cookie_name, $cookie_value, time() + $this->cookieExpiry); // 86400 = 1 day
                    }
                } else {
                    if ($this->redirectMethod == "unauthorised_access_page") {
                        wp_redirect($this->redirectPage);
                        exit();
                    } else {
                        die($this->redirectMsg);
                    }
                }
            }
		}
	}
}