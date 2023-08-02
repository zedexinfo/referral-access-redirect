<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( "RFACRDTCrCookie" ) ) {
	class RFACRDTCrCookie {
		protected static $instance;
		protected $pageRedirect;
		protected $allowOrigin;
		protected $interval;
		protected $cookieExpiry;
		protected $redirectPage;
		protected $redirectMsg;
		protected $redirectMethod;
        protected $cookieName;

		public function __construct() {
            $this->cookieName = get_option('cookie_name_option');
			$this->allowOrigin    = get_option( 'access_page_option' );
			$this->pageRedirect   = get_option( 'redirect_page_option' );
			$this->cookieExpiry   = get_option( 'cookie_expiry_option' );
			$this->interval       = get_option( 'interval_timeout_option' );
			$this->redirectPage   = get_option( "unauthorised_access_url_option" );
			$this->redirectMsg    = get_option( "unauthorised_access_message_option" );
			$this->redirectMethod = get_option( 'redirect_method_option' );

			add_action( 'init', [ $this, 'RFACRDT_set_cookie_and_redirect' ] );
			add_action( 'wp_enqueue_scripts', [ $this, 'RFACRDT_addScript' ] );
		}

		public function RFACRDT_addScript() {
			if ( $this->interval && $this->pageRedirect && $this->cookieExpiry && $this->allowOrigin ) {
				wp_enqueue_script( 'cookie_redirect', RFACRDT_JS_PATH . 'cookie_redirect.js', [], time(), true );

                $data = array(
                    'cookie_name' => get_option('cookie_name_option'),
                    'redirect_page'    => get_option( 'redirect_page_option' ),
                    'interval_timeout' => get_option( 'interval_timeout_option' )
                );
                $data = apply_filters('cookie_localize', $data);
                wp_localize_script( 'cookie_redirect', 'cookie_object', $data );
			}
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function RFACRDT_set_cookie_and_redirect() {
            if (!str_contains($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'wp-login.php')) {
                $cookie_value = "cookie_redirect";
                $url = wp_get_raw_referer();
                if (!isset($_COOKIE[$this->cookieName])) {
                    if (str_contains($this->allowOrigin, $url)) {
                        if (!isset($_COOKIE[$this->cookieName])) {
                            setcookie($this->cookieName, $cookie_value, time() + $this->cookieExpiry); // 86400 = 1 day
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
}