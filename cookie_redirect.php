<?php
/*
  * Plugin Name: Cookie Redirect
  * Description: The cookie redirection plugin enhances website security by redirecting users from a specific website to a designated page. It sets a cookie to track the allowed duration of their stay. If a user doesn't come from the referral site, they are automatically redirected to an error page. This plugin ensures the integrity of referral-based traffic and provides a customized experience based on the referral source.
  * Version: 1.0.0
  * Author: Dev@Zedex
  * Author URI: https://zedexinfo.com/
  * License:      GPL v2 or later
*/

if (!defined('ABSPATH')){ die(); }

if (!defined('RFACRDT_PLUGIN_DIR')){
    define('RFACRDT_PLUGIN_DIR',untrailingslashit( plugin_dir_path( __FILE__ )));
    define('RFACRDT_INCLUDES_PATH',untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/includes/');
    define('RFACRDT_TEMPLATES_PATH',untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/templates/');
    define('RFACRDT_JS_PATH', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) . '/assets/js/' );
}

if ( ! class_exists( 'cookieRedirect' ) ) {
    include_once RFACRDT_INCLUDES_PATH . "class-cr.php";
}

function RFACRDT_cookie_redirect_init(): RFACRDTcookieRedirect
{
    return RFACRDTcookieRedirect::getInstance();
}

register_activation_hook(__FILE__, [RFACRDTcookieRedirect::class, 'RFACRDT_defaultValues']);

register_deactivation_hook(__FILE__, [RFACRDTcookieRedirect::class, 'RFACRDT_deleteValues']);

RFACRDT_cookie_redirect_init();