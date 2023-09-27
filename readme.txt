=== Referral Access Redirect Plugin ===

Contributors: zxwpdev
Tags: redirect, referral, security, cookie
Requires at least: WordPress 4.0
Tested up to: WordPress 6.3.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Referral Access Redirect Plugin enhances website security by controlling access based on referral sources. Users from specified websites are redirected to a particular page on your WordPress site. The plugin uses cookies to track user access duration and offers settings for redirection when the cookie expires. It also provides methods to manage unauthorized access by either displaying a message or redirecting to a specified page.

== Installation ==

1. Upload the "referral-access-redirect" folder to "/wp-content/plugins/".
2. Activate the plugin via the "Plugins" menu in WordPress.
3. Navigate to the plugin settings in the WordPress dashboard.
4. Configure the plugin settings: set the cookie name, expiration time, check interval, permitted origin, redirection URL upon cookie expiration, and method for unauthorized access redirection.
5. Save your changes.
6. Users from the defined referral will be redirected based on these settings.
7. Unauthorized access or expired cookies will be handled as per the selected method.

== Admin Settings Fields ==

The plugin's admin settings offer the following options:

- **Cookie Name**: (Default: "cookie_redirect") Define the cookie's name.
- **Cookie Expiry Time**: (Default: 60 seconds) Set the access duration.
- **Set Interval Time**: (Default: 10 seconds) Set the time interval for cookie checks.
- **Allowed Origin**: Input the permitted source URL.
- **Redirection URL on Cookie Expiry**: Input the redirection URL for expired cookies.
- **Unauthorized Access Method**: Choose how to manage unauthorized access:
  - **Show a Message**: (Default) Display a user-defined message for unauthorized users.
  - **Redirect to a Specific Page**: Specify a redirection URL for unauthorized users.
- **Unauthorized Access Message**: (Default: "You have no permission to access this page") Set a message for unauthorized access.
- **Unauthorized Access Redirection URL**: Input the URL for unauthorized user redirection.
- **Clear Data on Deactivation**: Opt to erase all configuration values upon plugin deactivation.

== Frequently Asked Questions ==

Q: How does this plugin function?
A: It redirects users from designated websites to a particular page on your site. Access duration is tracked via cookies, and redirection settings are applied upon cookie expiry.

Q: Can I modify unauthorized user messages?
A: Absolutely! Adjust the message for unauthorized users in the plugin settings.

Q: What transpires upon plugin deactivation?
A: Data persists post-deactivation unless "Clear Data on Deactivation" is chosen; then, all data is removed upon deactivation.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
* Initial release of Referral Access Redirect.