<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( "RFACRDTCrAdminMenu" ) ) {
	class RFACRDTCrAdminMenu {
		protected static $instance;

		public function __construct() {
			add_action( "admin_menu", [ $this, "RFACRDT_cookie_details" ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'RFACRDT_addScript' ] );
		}

		public static function getInstance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function RFACRDT_addScript() {
			wp_enqueue_script( 'unauthorised_access', RFACRDT_JS_PATH . 'unauthorised_access.js' );
		}

		public function RFACRDT_cookie_details() {
			add_menu_page(
				"Cookie Details",
				"Add Cookie Details",
				"manage_options",
				"manage_cd",
				[ $this, "RFACRDT_cookie_detail_template" ] );

			add_action( 'admin_init', [ $this, 'RFACRDT_register_Cd_settings' ] );
		}

		public function RFACRDT_cookie_detail_template() {
			load_template( RFACRDT_TEMPLATES_PATH . 'temp-cookie-details.php' );
		}

		public function RFACRDT_sanitize_number( $number ) {
			return filter_var( $number, FILTER_SANITIZE_NUMBER_INT );
		}

		public function RFACRDT_cookie_name_field_validation( $value ) {
			if ( empty( $value ) ) {
				$value = get_option( 'cookie_name_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Cookie name cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_cookie_expiry_time_validation( $value ) {
			if ( empty( $value ) ) {
				$value = get_option( 'cookie_expiry_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Cookie expiry time cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_interval_timeout_validation( $value ) {
			if ( empty( $value ) ) {
				$value = get_option( 'interval_timeout_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Interval time cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_access_page_url_validation( $value ) {
			if ( empty( $value ) ) {
				$value = get_option( 'access_page_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Allowed origin cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_redirect_page_url_validation( $value ) {
			if ( empty( $value ) ) {
				$value = get_option( 'redirect_page_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Redirect page url cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_unauthorised_access_message_validation( $value ) {
			if ( empty( $value ) && get_option( 'redirect_method_option' ) == 'unauthorised_access_message' ) {
				$value = get_option( 'unauthorised_access_message_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Unauthorised access message field cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_unauthorised_access_url_field_validation( $value ) {
			if ( empty( $value ) && get_option( 'redirect_method_option' ) == 'unauthorised_access_page' ) {
				$value = get_option( 'unauthorised_access_url_option' );
				add_settings_error( 'cd-setting-section', 'cd-setting-section_error', 'Unauthorised access url field cannot be empty', 'error' );
			}

			return $value;
		}

		public function RFACRDT_register_Cd_settings() {

			$admin_menu = apply_filters( 'cd_admin_menu_filter', [
				'cookie_name_option'                 => array(
					'id'                  => 'cookie_name',
					'title'               => 'Cookie Name',
					'callback'            => 'cookie_name_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_cookie_name_field_validation'
				),
				'cookie_expiry_option'               => array(
					'id'                  => 'cookie_expiry_time',
					'title'               => 'Cookie Expiry Time (in seconds)',
					'callback'            => 'cookie_expiry_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_cookie_expiry_time_validation'
				),
				'interval_timeout_option'            => array(
					'id'                  => 'interval_timeout',
					'title'               => 'Set Interval Time (in seconds)',
					'callback'            => 'interval_timeout_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_interval_timeout_validation'
				),
				'access_page_option'                 => array(
					'id'                  => 'access_page_url',
					'title'               => 'Allowed Origin',
					'callback'            => 'access_page_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_access_page_url_validation'
				),
				'redirect_page_option'               => array(
					'id'                  => 'redirect_page_url',
					'title'               => 'URL of the page to be redirected to when cookie expires',
					'callback'            => 'redirect_page_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_redirect_page_url_validation'
				),
				'redirect_method_option'             => array(
					'id'       => 'redirect_method',
					'title'    => 'Unauthorised access redirect Method',
					'callback' => 'redirect_method_callback',
					'page'     => 'cd-setting-section',
					'section'  => 'Cd_admin_setting_section'
				),
				'unauthorised_access_url_option'     => array(
					'id'                  => 'unauthorised_access_url',
					'title'               => 'URL of the page to be redirected to when unauthorised access',
					'callback'            => 'unauthorised_access_url_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_unauthorised_access_url_field_validation'
				),
				'unauthorised_access_message_option' => array(
					'id'                  => 'unauthorised_access_message',
					'title'               => 'Message to be shown when unauthorised access',
					'callback'            => 'unauthorised_access_message_callback',
					'page'                => 'cd-setting-section',
					'section'             => 'Cd_admin_setting_section',
					'validation callback' => 'RFACRDT_unauthorised_access_message_validation'
				),
				'delete_values_option'               => array(
					'id'       => 'delete_values',
					'title'    => 'Delete values on plugin deactivation',
					'callback' => 'delete_values_callback',
					'page'     => 'cd-setting-section',
					'section'  => 'Cd_admin_setting_section'
				)
			] );

			add_settings_section(
				__( 'Cd_admin_setting_section' ),
				__( 'Cookie Details' ),
				'',
				'cd-setting-section'
			);

			foreach ( $admin_menu as $key => $value ) {
				register_setting( 'cd-setting-section', $key, [ $this, $value["validation callback"] ] );
				add_settings_field(
					$value["id"],
					$value["title"],
					[ $this, $value["callback"] ],
					$value["page"],
					$value["section"]
				);
			}
		}

		public function cookie_name_callback() {
			$cookie_name = get_option( 'cookie_name_option' );
			?>
            <input type="text" name="cookie_name_option" class="regular-text"
                   value="<?php echo isset( $cookie_name ) ? esc_attr( $cookie_name ) : ''; ?> ">
			<?php
		}

		public function cookie_expiry_callback() {
			$cookie_expiry_time = get_option( 'cookie_expiry_option' );
			?>
            <input type="text" name="cookie_expiry_option" class="regular-text"
                   value="<?php echo isset( $cookie_expiry_time ) ? esc_attr( $cookie_expiry_time ) : ''; ?> ">
			<?php
		}

		public function interval_timeout_callback() {
			$interval_timeout = get_option( 'interval_timeout_option' );
			?>
            <input type="text" name="interval_timeout_option" class="regular-text"
                   value="<?php echo isset( $interval_timeout ) ? esc_attr( $interval_timeout ) : ''; ?> ">
			<?php
		}

		public function access_page_callback() {
			$access_page_url = get_option( 'access_page_option' );
			?>
            <input type="text" name="access_page_option" class="regular-text"
                   value="<?php echo isset( $access_page_url ) ? esc_attr( $access_page_url ) : ''; ?> ">
            <p class="description" id="tagline-description">For multiple domains enter URLs separated by comma.</p>
			<?php
		}

		public function redirect_page_callback() {
			$redirect_page_url = get_option( 'redirect_page_option' );
			?>
            <input type="text" name="redirect_page_option" class="regular-text"
                   value="<?php echo isset( $redirect_page_url ) ? esc_attr( $redirect_page_url ) : ''; ?> ">
			<?php
		}

		public function redirect_method_callback() {
			$redirect_method = get_option( 'redirect_method_option' );
			?>
            <select type="text" id="method" name="redirect_method_option" class="regular-text">
                <option value="" disabled>Select Any One</option>
                <option id="unauthorised_access_page_select"
                        value="unauthorised_access_page" <?php selected( 'unauthorised_access_page', $redirect_method ) ?> >
                    Redirect to a specific page
                </option>
                <option id="unauthorised_access_message_select"
                        value="unauthorised_access_message" <?php selected( 'unauthorised_access_message', $redirect_method ) ?> >
                    Show a message
                </option>
            </select>
			<?php
		}

		public function unauthorised_access_url_callback() {
			$unauthorised_access_url = get_option( 'unauthorised_access_url_option' );
			?>
            <input id="unauthorised_access_page_input" type="text" name="unauthorised_access_url_option"
                   class="regular-text"
                   value="<?php echo isset( $unauthorised_access_url ) ? esc_attr( $unauthorised_access_url ) : ''; ?> ">
			<?php
		}

		public function unauthorised_access_message_callback() {
			$unauthorised_access_message = get_option( 'unauthorised_access_message_option' );
			?>
            <input id="unauthorised_access_message_input" type="text" name="unauthorised_access_message_option"
                   class="regular-text"
                   value="<?php echo isset( $unauthorised_access_message ) ? esc_attr( $unauthorised_access_message ) : ''; ?> ">
			<?php
		}

		public function delete_values_callback() {
			$delete_values = get_option( 'delete_values_option' );
			?>
            <input type="checkbox" name="delete_values_option" value="1" <?php checked( '1', $delete_values ); ?> />
			<?php
		}
	}
}