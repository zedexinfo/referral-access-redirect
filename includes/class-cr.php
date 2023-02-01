<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists("cookieRedirect")) {
    class cookieRedirect
    {
        protected static $instance;
        public $CrAdminMenu;
        public $CrCookie;

        public function __construct()
        {
            add_action('plugins_loaded', array($this, 'initialize'), 20);
        }

        public static function defaultValues(){
            $default_values = [
                'cookie_expiry_option' => 40,
                'interval_timeout_option' => 5,
                'redirect_method_option' => 'unauthorised_access_message',
                'unauthorised_access_message_option' => 'You have no permission to access this page'
            ];

            foreach ($default_values as $key => $value){
                if (get_option($key) == false) {
                    update_option($key, $value);
                }
            }
        }

        public static function getInstance()
        {
            if (self::$instance === null) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function initialize()
        {
            $this->includes();
            $this->init();
        }

        public function includes()
        {
            include_once CR_INCLUDES_PATH . 'class-cr-admin-menu.php';
            if (!is_admin()) {
                include_once CR_INCLUDES_PATH . 'class-cr-cookie.php';
            }

        }

        public function init()
        {
            $this->CrAdminMenu = CrAdminMenu::getInstance();
                if (!is_admin()) {
                    $this->CrCookie = CrCookie::getInstance();
                }
            }
        }
}