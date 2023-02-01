<?php
/*
  Plugin Name: Cookie Redirect
  Description: Plugin to redirect to a website when cookie expires
  Version: 1.0.0
  Author: Dev@StableWP
  Author URI: https://dukeheightsv2.stablewplite.com/
*/

if (!defined('ABSPATH')){ die(); }

if (!defined('CR_PLUGIN_DIR')){
    define('CR_PLUGIN_DIR',untrailingslashit( plugin_dir_path( __FILE__ )));
    define('CR_INCLUDES_PATH',untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/includes/');
    define('CR_TEMPLATES_PATH',untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/');
    define('CR_JS_PATH', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) . '/assets/js/' );
}

if ( ! class_exists( 'cookieRedirect' ) ) {
    include_once CR_INCLUDES_PATH . "class-cr.php";
}

function cookie_redirect_init(): cookieRedirect
{
    return cookieRedirect::getInstance();
}


register_activation_hook(__FILE__, cookieRedirect::defaultValues());


function deleteValues()
{
    $delete_values = ['cookie_expiry_option', 'interval_timeout_option', 'access_page_option', 'redirect_page_option', 'redirect_method_option', 'unauthorised_access_url_option', 'unauthorised_access_message_option'];

    if (get_option('delete_values_option') == 1) {
        foreach ($delete_values as $delete_value) {
            update_option($delete_value, '');
        }
    }
}
register_deactivation_hook(__FILE__, 'deleteValues');

cookie_redirect_init();