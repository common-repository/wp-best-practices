<?php
/**
 * Plugin Name: WP Best Practices
 * Plugin URI: http://http://wordpress.org/plugins/wp-best-practices
 * Description: This plugin is designed to implement the latest WordPress best practices. The plugin allows you to maintain your site's WordPress version a secret by removing the meta generator tag, denying access to the wp-config.php files for unauthorized users, blocking access to the wp-includes directory for unathorized users, disabling file editing, removing the Compatibility View button from IE, and disabling XML-RPC functionality. 
 * Author: Ed Orsini
 * Tags: meta, generator, security, remove generator, standards, practices, delete readme.html, ability to hide login page, remove wordpress version, disbale file editing, remove internet explorer compatibility mode, set internet explorer mode to edge
 * Version: 1.5.3
 **/

/*----------------------------------------------------------------------------
Copyright 2014  Ed Orsini

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
----------------------------------------------------------------------------*/

$ejo_wp_best_practices = new ejo_wp_best_practices();

// On activation of this plugin
register_activation_hook( WP_PLUGIN_DIR . '/wp-best-practices/wp-best-practices.php', array($ejo_wp_best_practices, 'activate') );

// On deactivation of this plugin
register_deactivation_hook( WP_PLUGIN_DIR . '/wp-best-practices/wp-best-practices.php', array($ejo_wp_best_practices, 'deactivate') );

register_uninstall_hook( WP_PLUGIN_DIR . '/wp-best-practices/wp-best-practices.php', array($ejo_wp_best_practices, 'uninstall')  );

class ejo_wp_best_practices {
    public function activate() {
        // Log plugin activation
        $text = 'Activated plugin';
        $this->log_entry($text);
        // Add database field that will contain the password for the cookie (for login page)
        $this->add_database_fields();
        // Edit .htaccess file to hide WordPress Version number from the wp-login.php file
        $this->add_htaccess_entry();
    }

    public function deactivate() {
        // Log plugin deactivation
        $text = 'Deactivated plugin';
        $this->log_entry($text);
        // Remove the entry made to the .htaccess file made by this plugin
        $this->remove_htaccess_entry();
        // Removes database field
        //$this->remove_database_fields();
    }
 
    public function uninstall() {
        // Removes database fields
        $this->remove_database_fields();
    }

    public function log_entry($text=''){
        // Do nothing 
        // Only used for debugging purposes.
        /*
        $time = date('d-m-Y H:i:s ');
        file_put_contents(dirname(__FILE__) . '/log.txt', $time . ' - ' . $text . "\n", FILE_APPEND | FILE_TEXT);
        */
    }
    
    public function add_htaccess_entry(){
        if(get_option('wp_best_practices_enableHtaccessEntry') == 1) {
            $absolutePath = ABSPATH;
            $content = '#{WordPress Best Practices Plugin}' . "\n\n";
            $content .= '# Deny access to wp-config.php file if anyone is surfing for it.' . "\n";
            $content .= '<Files wp-config.php>' . "\n" . "  Order deny,allow" . "\n" . "    Deny from all" ."\n" . "</Files>" . "\n\n";
            $content .= '# Prevent access to .svn files' . "\n";
            $content .= 'RewriteRule ^(.*/)?\.svn/ - [F,L]' . "\n";
            $content .= 'ErrorDocument 403 "Access Forbidden"' . "\n\n";
            $content .= '# Secure the wp-includes files' . "\n";
            $content .= '<IfModule mod_rewrite.c>' . "\n";
            $content .= 'RewriteEngine On' . "\n";
            $content .= 'RewriteBase /' . "\n";
            $content .= 'RewriteRule ^wp-admin/includes/ - [F,L]' . "\n";
            $content .= 'RewriteRule !^wp-includes/ - [S=3]' . "\n";
            $content .= 'RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]' . "\n";
            $content .= 'RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]' . "\n";
            $content .= 'RewriteRule ^wp-includes/theme-compat/ - [F,L]' . "\n";
            $content .= '</IfModule>' . "\n\n";
            $content .= '#{/WordPress Best Practices Plugin}';

            file_put_contents($absolutePath . '/.htaccess', $content, FILE_APPEND | FILE_TEXT);
            // Add entry to the log file
            $text = 'Added .htaccess entry';
            $this->log_entry($text);
        }

    }

    public function remove_htaccess_entry() {
        $absolutePath = ABSPATH;
        $fileContent = file_get_contents($absolutePath . '/.htaccess');
        $regex = "#([{]WordPress Best Practices Plugin[}])(.*)([{]/WordPress Best Practices Plugin[}])#s";
        $output = preg_replace($regex,"",$fileContent);
        file_put_contents($absolutePath . '/.htaccess', $output);
        // Add entry to the log file
        $text = 'Removed .htaccess entry';
        $this->log_entry($text);
    }

    public function add_database_fields(){
        // Creates new database field
        add_option("wp_best_practices_disableCompatibilityView", '1', '', '');
        add_option("wp_best_practices_disableXMLRPC", '1', '', '');
        add_option("wp_best_practices_disableFileEdit", '1', '', '');
        add_option("wp_best_practices_disableGeneratorMetaTag", '1', '', '');
        add_option("wp_best_practices_enableHtaccessEntry", '1', '', '');
    }

    public function remove_database_fields(){
        // Removes database field
        delete_option('wp_best_practices_cookie_password');
        delete_option('wp_best_practices_use_password');
        delete_option('wp_best_practices_htaccess_password_entry_exists');
        delete_option('wp_best_practices_disableCompatibilityView');
        delete_option('wp_best_practices_disableXMLRPC');
        delete_option('wp_best_practices_disableFileEdit');
        delete_option('wp_best_practices_disableGeneratorMetaTag');
        delete_option('wp_best_practices_enableHtaccessEntry');
    }
                                  
} // end of ejo_wp_best_practices object



/*********************
 * Definitions       *
 *********************/
// Disable file editing. More info: (http://codex.wordpress.org/Hardening_WordPress)
$ejo_wp_best_practices->disableFileEdit_no_checked = '';
$ejo_wp_best_practices->disableFileEdit_yes_checked = '';
if(get_option('wp_best_practices_disableFileEdit') == 1) {
    define( 'DISALLOW_FILE_EDIT', true );
    $ejo_wp_best_practices->disableFileEdit_yes_checked = 'CHECKED ';
} else {
    $ejo_wp_best_practices->disableFileEdit_no_checked = 'CHECKED ';
}

$ejo_wp_best_practices->enableHtaccessEntry_no_checked = '';
$ejo_wp_best_practices->enableHtaccessEntry_yes_checked = '';
if(get_option('wp_best_practices_enableHtaccessEntry') == 1) {
    $ejo_wp_best_practices->enableHtaccessEntry_yes_checked = 'CHECKED ';
} else {
    $ejo_wp_best_practices->enableHtaccessEntry_no_checked = 'CHECKED ';
}

/*********************
 * Functions         *
 *********************/
function ejo_add_to_head() {
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />' ;
    /* 
    Edge mode tells Internet Explorer to display content in the highest mode available. With Internet Explorer 9, this is equivalent to IE9 mode. If a future release of Internet Explorer supported a higher compatibility mode, pages set to edge mode would appear in the highest mode supported by that version. Those same pages would still appear in IE9 mode when viewed with Internet Explorer 9. 
    */
}

// Remove the WordPress Generator Meta Tag
function remove_generator_filter() { 
    return '';
}

/*********************
 * Actions           *
 *********************/
// Disable the Compatibility View mode on Internet Explorer
$ejo_wp_best_practices->disableCompatibilityView_no_checked = '';
$ejo_wp_best_practices->disableCompatibilityView_yes_checked = '';
if(get_option('wp_best_practices_disableCompatibilityView') == 1) {
    add_action('wp_head', 'ejo_add_to_head',1,1);
    $ejo_wp_best_practices->disableCompatibilityView_yes_checked = 'CHECKED ';
} else{
    $ejo_wp_best_practices->disableCompatibilityView_no_checked = 'CHECKED ';
}

// Removes the Generator Meta Tag 
$ejo_wp_best_practices->disableGeneratorMetaTag_no_checked = '';
$ejo_wp_best_practices->disableGeneratorMetaTag_yes_checked = '';
if(get_option('wp_best_practices_disableGeneratorMetaTag') == 1) {
    remove_action('wp_head', 'wp_generator');
    $ejo_wp_best_practices->disableGeneratorMetaTag_yes_checked = 'CHECKED ';
    // Removes the WordPress Version from the RSS feeds, etc.
    if (function_exists('add_filter')) {
        $types = array('html', 'xhtml', 'atom', 'rss2', 'comment', 'export');
        foreach ( $types as $type ){
            add_filter('get_the_generator_'.$type, 'remove_generator_filter');
        }
    }
} else {
    $ejo_wp_best_practices->disableGeneratorMetaTag_no_checked = 'CHECKED ';
}

/*********************
 * Filters           *
 *********************/
// Disable the XML-RPC (pingback)
$ejo_wp_best_practices->disableXMLRPC_yes_checked = '';
$ejo_wp_best_practices->disableXMLRPC_no_checked = '';
if(get_option('wp_best_practices_disableXMLRPC') == 1) {
    add_filter(‘xmlrpc_methods’, function($methods) {
        unset( $methods['pingback.ping'] );
        return $methods;
    });
    $ejo_wp_best_practices->disableXMLRPC_yes_checked = 'CHECKED ';
} else {
    $ejo_wp_best_practices->disableXMLRPC_no_checked = 'CHECKED ';
}

// Add admin CSS
add_action('admin_print_styles', 'add_my_stylesheet');

function add_my_stylesheet() {
    wp_enqueue_style( 'wp-best-practices-css', plugins_url( '/css/admin.css', __FILE__ ) );
}

/*********************
 * Admin Area        *
 *********************/
// Desc: For setting the password value for the cookie (used on the login page)
if ( is_admin() ){

    // Call the HTML code 
    add_action('admin_menu', 'wp_best_practices_admin_menu');

    function wp_best_practices_admin_menu() {
        add_options_page('WP Best Practices', 'WP Best Practices', 'administrator', 'wp_best_practices_id', 'wp_best_practices_options_html_page');
    }
}

function wp_best_practices_options_html_page() {
    global $ejo_wp_best_practices;
    include( plugin_dir_path( __FILE__ ) . 'admin/admin_page.php');
}

// Omitting the closing PHP tag at the end of a file is preferred.  For more information: http://make.wordpress.org/core/handbook/coding-standards/php/
