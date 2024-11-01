=== WP Best Practices ===
Contributors: edorsini
Tags: meta, generator, security, remove generator, wordpress version,
standards, practices
Requires at least: 2.0.2
Tested up to: 3.9.1
Stable tag: 1.5.3

This plugin is designed to implement the latest WordPress best practices
around security into your WordPress website.

== Description ==

This plugin is designed to implement the latest WordPress best practices
around security into your WordPress website.  

= Features =
1. Deny access to the wp-config.php file to anyone surfing for it. <http://codex.wordpress.org/Hardening_WordPress#Securing_wp-config.php>
2. Deny access to .svn files to anyone surfing for it.
3. Block access to wp-includes scripts to not intended users. <http://codex.wordpress.org/Hardening_WordPress#Securing_wp-includes>
4. Disable file editing. <http://codex.wordpress.org/Hardening_WordPress>
5. Remove the Compatibility View button on Internet Explorer.
6. Remove the meta name generator tag from the header of every page, including RSS feeds, which contains your site's WordPress version.
7. Disable the XML-RPC (pingback) functionality to help avoid DDoS attacks. <http://bit.ly/1o9RsFA>

For more information, questions, requests, or comments, please email the developer.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `wp-best-standards.zip` to the `/wp-content/plugins/` directory
2. Unzip the file 
3. Activate the plugin through the 'Plugins' menu in WordPress
4. You are all set! Enjoy!

== Frequently Asked Questions ==

= The Meta Name Generator is still displaying the WordPress version.  How could this be?  =

Make sure that your template does not have a hard coded reference within the header.php file.  Some older templates seem to have this reference. Please delete or comment the line.



== Screenshots ==

1. This screen shot illustrates the admin section of the plugin which allows you to hide the login page

== Changelog ==
= 1.5.3 =
* Performed code cleanup and removed functionality not used.

= 1.5.3 =
* Clean up.

= 1.5.1 =
* Removes the compatibility mode from Internet Explorer

= 1.5 =
* Clean up.

= 1.4 =
* Disables the file editing of themes and plugins in the admin dashboard.
* Secures the wp-includes folder.
* Secures the wp-config.php file.

= 1.3 =
* This release disabled the XML-RPC functionality in order to help prevent denial-of-service (DDoS) attacks.

= 1.2 =
* Minor code cleanup.

= 1.1 =
* This release included the ability to hide the WordPress version from the wp-login.php file.
* Minor code cleanup.

= 1.0 =
* The original release of this plugin.
* This release included the ability to remove the WordPress version from the meta generator tag and the readme.html file.

== Upgrade Notice ==

= 1.1 =
This version allows you to hide the WordPress version number from the wp-login.php page. Basically, you get to hide the login page from the average user and therefore prevent the WordPress version from been displayed.  Please read more about this on the official plugin site.

