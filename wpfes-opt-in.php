<?php

/*
Plugin Name: Newsletter Plugin
Plugin URI: http://www.fastemailsender.com/plugins/wordpress-newsletter-plugin/
Description: Designed with speed in mind, this FREE plugin enables any website/blog to store a list of newsletter subscriptions. You can store custom fields, like gender, country or job department, and send emails to your subscribers straight from your website's admin interface. The subscribers list can also be downloaded as a CSV file, compatible with most newsletter software programs. The plugin features a double-opt-in process, so visitors can only register themselves, and a newsletter-agreement box, to keep complaints about spamming to a minimum. To make it easier for you to use the plugin, there is a Custom CSS field, so you don't have to change any files in your theme.
Version: 2.1
Author: Fast Email Sender Team
Author URI: 
*/

/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

//

global $wpfes_db_version;

$wpfes_db_version = "0.1";
global $wpfes_install_folder;
global $wpfes_install_filename;
$wpfes_install_folder=basename(dirname(__FILE__));
$wpfes_install_filename=basename(__FILE__);

add_action('wp_ajax_send_mass_mail', 'send_mass_mail_callback');
global $wpfes_window_message;


//this file contains the functions and code.
require_once(dirname(__FILE__).'/includes/opt-in.php');

//////////////cpanel pear installation of Mail.php
//$pear_path=dirname(__FILE__);
//while(basename($pear_path)!='public_html' && !file_exists($pear_path).'/public_html/'){
//    $pear_path=dirname($pear_path);
//
//    if(basename($pear_path)=='public_html'){
//        $pear_path=dirname($pear_path);
//        break;
//    }
//}
//$pear_path=$pear_path.'/php/';
//ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . $pear_path);
////echo(ini_get('include_path'));
//////////////cpanel pear installation of Mail.php

//require_once(dirname(__FILE__).'/includes/smtp-class.php');

function wpfes_echo_message($msg, $return = false){
global $wpfes_window_message;
//    $ret = '
//<script type="text/javascript">
//    wp_fes_newsletter_status_box_show(\''.$msg.'\');
//script>';
//    if($return){
//        return $ret;
//    } else {
//        echo($ret);
//    }
    $wpfes_window_message=$msg;
    return  '';
}

function send_mass_mail_callback() {
	global $wpdb; // this is how you get access to the database

	require_once(dirname(__FILE__).'/includes/send-mail.php');

	die(); // this is required to return a proper result
}

function wpfes_show_form($rtn = 0) {	
	require(dirname(__FILE__).'/includes/subs-form.php');
	if ($rtn) {
		return $out;
	}
	else {
		echo $out;
	}
}

function wpfes_getip() {
	if (isset($_SERVER)) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip_addr = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} 
		elseif (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$ip_addr = $_SERVER["HTTP_CLIENT_IP"];
		} 
		else {
			$ip_addr = $_SERVER["REMOTE_ADDR"];
		}
	} 
	else {
		if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$ip_addr = getenv( 'HTTP_X_FORWARDED_FOR' );
		} 
		elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
			$ip_addr = getenv( 'HTTP_CLIENT_IP' );
		} 
		else {
			$ip_addr = getenv( 'REMOTE_ADDR' );
    	}
	}
	return $ip_addr;
}

function wpfes_has_email_headers($text) {
   return preg_match("/(%0A|%0D|\n+|\r+)(content-type:|to:|cc:|bcc:)/i", $text);
}

function wpfes_install() {
	global $wpdb;
	global $wpfes_db_version;

	require_once(dirname(__FILE__).'/includes/install.php');
	
}

function wpfes_options() {
	global $wpdb;
	$table_users = $wpdb->prefix . "wpfes_users";

	require_once(dirname(__FILE__).'/includes/options-management.php');
	require_once(dirname(__FILE__).'/includes/header.php');
	
?>
<div class="wrap">
  <h2>Newsletter Plugin Options</h2>
<?php
wpfes_echo_header();


switch($_GET['wpfes-mode']){
	/////form to change settings
	case 'options':
		require_once(dirname(__FILE__).'/includes/options-form.php');
		break; 
	case 'list':
		require_once(dirname(__FILE__).'/includes/subs-list.php');
		break; 
	case 'new-mail':
		require_once(dirname(__FILE__).'/includes/new-mail.php');
		break;
} //end switch case $_GET['wpfes-mode'];
?>

</div>
<?php
}

function wpfes_widget_init() {
	global $wp_version;

	if (!function_exists('register_sidebar_widget')) {
		return;
	}

	function wpfes_widget($args) {
		extract($args);
		echo $before_widget . $before_title;
		echo get_option('wpfes_widget_title');
		echo $after_title;
		wpfes_opt_in();
		echo $after_widget;
	}

	function wpfes_widget_control() {
		$title = get_option('wpfes_widget_title');
		if ($_POST['wpfes_submit']) {
			$title = stripslashes($_POST['wpfes_widget_title']);
			update_option('wpfes_widget_title', $title );
		}
		echo '<p>Title:<input type="text" value="';
		echo $title . '" name="wpfes_widget_title" id="wpfes_widget_title" /></p>';
		echo '<input type="hidden" id="wpfes_submit" name="wpfes_submit" value="1" />';
	}

	$width = 300;
	$height = 100;
	if ( '2.2' == $wp_version || (!function_exists( 'wp_register_sidebar_widget' ))) {
		register_sidebar_widget('Newsletter Plugin', 'wpfes_widget');
		register_widget_control('Newsletter Plugin', 'wpfes_widget_control', $width, $height);
	} else {

	//if v2.2+
	$width = '';
	$height = '';
		$size = array('width' => $width, 'height' => $height);
		$class = array( 'classname' => 'wpfes_opt_in', 'description' => __('Newsletter form for email subscription')); // css classname
		wp_register_sidebar_widget('wpfes', 'Newsletter Plugin', 'wpfes_widget', $class);
		wp_register_widget_control('wpfes', 'Newsletter Plugin', 'wpfes_widget_control', $size);
	}
	if (function_exists('register_sidebar_module')) {
		$class = array( 'classname' => 'wpfes_opt_in'); // css classname
		register_sidebar_module('Newsletter Plugin', 'wpfes_widget', '', $class);
		register_sidebar_module_control('Newsletter Plugin', 'wpfes_widget_control');
	}
}

function wpfes_add_to_menu() {
	add_options_page('WP Fast Email Sender Opt-in Options', 'Newsletter Plugin', 7, __FILE__, 'wpfes_options' );
	add_filter('plugin_action_links', 'wpfes_filter_plugin_actions_links', 10, 2);
}

function wpfes_filter_plugin_actions_links($links, $file) 	{
	global $wpfes_install_folder;
	global $wpfes_install_filename;
	if ($file ==$wpfes_install_folder.'/'.$wpfes_install_filename) 	{
		$settings_link = $settings_link = '<a href="options-general.php?page='.$wpfes_install_folder.'/'.$wpfes_install_filename.'">' . __('Settings') . '</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}

function wpfes_opt_in_form_func( $atts ) {
        return wpfes_opt_in(true );
	//$ret= wpfes_show_form(true);
        
}

function wpfes_headerpublic(){
    $link=site_url().'/wp-content/plugins/fes-wordpress-newsletter/includes/js.php';
    $link=wp_nonce_url($link, 'wpfes_headerpublic_nonce');
    echo('<script type="text/javascript" src="'.$link.'"></script>');

    $link=site_url().'/wp-content/plugins/fes-wordpress-newsletter/includes/formcss.php';
    $link=wp_nonce_url($link, 'wpfes_headerpublic_nonce');

    echo('<link rel="stylesheet" type="text/css" href="'.$link.'" />');
}
function wpfes_headeradmin(){
    wpfes_headerpublic();//normal JS
    echo('<link rel="stylesheet" type="text/css" href="'.site_url().'/wp-content/plugins/fes-wordpress-newsletter/includes/admin.css" />');
}

add_action('wp_head', 'wpfes_headerpublic');//only works on public
add_action('admin_head', 'wpfes_headeradmin');//only works on admin

add_shortcode('wpfes_opt_in_form', 'wpfes_opt_in_form_func');

register_activation_hook(__FILE__, 'wpfes_install');
add_action('admin_menu', 'wpfes_add_to_menu');
add_action('init', 'wpfes_widget_init');

?>