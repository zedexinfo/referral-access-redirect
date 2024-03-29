<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( "RFACRDTcookieRedirect" ) ) {
	class RFACRDTcookieRedirect {
		protected static $instance;
		public $CrAdminMenu;
		public $CrCookie;

		public function __construct() {
			add_action( 'plugins_loaded', array( $this, 'initialize' ), 20 );
		}

		public static function RFACRDT_defaultValues() {
			$default_values = [
				'RFACRDT_cookie_name_option'                 => 'cookie_redirect',
				'RFACRDT_cookie_expiry_option'               => 60,
				'RFACRDT_interval_timeout_option'            => 10,
				'RFACRDT_redirect_method_option'             => 'unauthorised_access_message',
				'RFACRDT_unauthorised_access_message_option' => 'You have no permission to access this page'
			];

			foreach ( $default_values as $key => $value ) {
				if ( get_option( $key ) == false ) {
					update_option( $key, $value );
				}
			}
		}

		public static function RFACRDT_deleteValues() {
			$delete_values = [
				'RFACRDT_cookie_name_option',
				'RFACRDT_cookie_expiry_option',
				'RFACRDT_interval_timeout_option',
				'RFACRDT_access_page_option',
				'RFACRDT_redirect_page_option',
				'RFACRDT_redirect_method_option',
				'RFACRDT_unauthorised_access_url_option',
				'RFACRDT_unauthorised_access_message_option'
			];

			if ( get_option( 'RFACRDT_delete_values_option' ) == 1 ) {
				foreach ( $delete_values as $delete_value ) {
					delete_option( $delete_value );
				}
			}
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function initialize() {
			$this->includes();
			$this->init();
		}

		public function includes() {
			include_once RFACRDT_INCLUDES_PATH . 'class-cr-admin-menu.php';
			if ( ! is_admin() ) {
				include_once RFACRDT_INCLUDES_PATH . 'class-cr-cookie.php';
			}

		}

		public function init() {
			$this->CrAdminMenu = RFACRDTCrAdminMenu::getInstance();
			if ( ! is_admin() ) {
				$this->CrCookie = RFACRDTCrCookie::getInstance();
			}
		}
	}
}