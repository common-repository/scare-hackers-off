<?php

/*
Plugin Name: Scare Hackers Off
Plugin URI: https://riotweb.nl
Description: Scare off hackers by redirecting them to the FBI.
Author: RiotWeb
Version: 1.1
Author URI: https://riotweb.nl/plugins
*/

if ( !defined('ABSPATH') )
	die('-1');

// Add gzip rules to .htaccess
function sco_redirect_htaccess( $rules )
{
$my_content = <<<EOD
\n # START Redirect
Redirect 301 /wp-config.php http://www.fbi.gov/
Redirect 301 /wp-config-sample.php http://www.fbi.gov/
Redirect 301 /xmlrpc.php http://www.fbi.gov/
Redirect 301 /license.txt http://www.fbi.gov/
Redirect 301 /readme.html http://www.fbi.gov/
# END Redirect\n
EOD;
    return $my_content . $rules;
}
add_filter('mod_rewrite_rules', 'sco_redirect_htaccess');

// Calling this function will make flush_rules to be called at the end of the PHP execution
function sco_flush_rules() {

    global $wp_rewrite;

    // Flush the rewrite rules
    $wp_rewrite->flush_rules();

}

// On plugin activation, call the function that will make flush_rules to be called at the end of the PHP execution
register_activation_hook( __FILE__, 'sco_flush_rules' );

