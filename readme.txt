=== Referral Access Redirect Plugin ===

Contributors: YourName
Tags: redirect, referral, security, cookie
Requires at least: WordPress version 4.0
Tested up to: WordPress version 6.2.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

The Referral Access Redirect Plugin is a powerful tool that enhances website security and allows for controlled access based on referral sources. It redirects users from a specified website to a designated page on your WordPress website. The plugin tracks user access duration using a cookie and provides customizable options for redirection upon cookie expiration. Additionally, it offers methods to handle unauthorized access, either by showing a message or redirecting to a specific page. 

== Installation ==

1. Upload the "referral-access-redirect" folder to the "/wp-content/plugins/" directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Go to the plugin settings page located in the WordPress dashboard.
4. Configure the plugin options, such as setting the cookie name, expiry time, interval time, allowed origin, URL for cookie expiry redirection, and unauthorized access redirect method.
5. Save the settings.
6. Visitors coming from the specified referral source will be redirected to the designated page based on the configured settings.
7. Unauthorized users or expired cookie instances will be handled according to the chosen unauthorized access redirect method.

== Admin Settings Fields ==

The plugin provides the following configuration options in the admin settings:

- Cookie Name (default: "cookie_redirect"): Set the name of the cookie that tracks user access duration.
- Cookie Expiry Time (default: 60 seconds): Specify the duration until which the user is allowed to access the site.
- Set Interval Time (default: 10 seconds): Define the time interval to check if the cookie has expired.
- Allowed Origin: Enter the URL of the page from which users will be permitted to access the site.
- URL of the Page to be Redirected to When Cookie Expires: Specify the URL where users will be redirected upon cookie expiration.
- Unauthorized Access Redirect Method: Choose from two methods to redirect users from unauthorized domains:
  - Show a Message (default): Display a customizable message to users coming from unauthorized domains.
  - Redirect to a Specific Page: Specify a URL to redirect users coming from unauthorized domains.
- Message to be Shown When Unauthorized Access (default: "You have no permission to access this page"): Customize the message displayed to users from unauthorized domains.
- URL of the Page to be Redirected to When Unauthorized Access: Enter the URL where users from unauthorized domains will be redirected.
- Delete Values on Plugin Deactivation: Select this option to delete the entered field values when deactivating the plugin.

== Frequently Asked Questions ==

Q: How does the Referral Access Redirect Plugin work?
A: The plugin redirects users from a specified website to a designated page on your WordPress website. It tracks user access duration using a cookie and provides customizable options for redirection upon cookie expiration.

Q: Can I customize the messages shown to unauthorized users?
A: Yes, you can customize the message displayed to users coming from unauthorized domains. Simply enter your desired message in the corresponding field in the plugin settings.

Q: What happens if the plugin is deactivated?
A: If the plugin is deactivated, the entered field values will be retained unless the "Delete Values on Plugin Deactivation" option is selected. In that case, the values will be deleted when deactivating the plugin.

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release of the Referral Access