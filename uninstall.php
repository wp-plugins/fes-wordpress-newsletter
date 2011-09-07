<?php

if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
    exit();

global $wpdb;
$table_users = $wpdb->prefix . "wpfes_users";


// Table did not exist; create new
$sql = "DROP TABLE `" . $table_users . "`";
$result = $wpdb->query($sql);

delete_option("wpfes_db_version");

delete_option('wpfes_widget_title');
delete_option('wpfes_email_from');
delete_option('wpfes_email_subject');
delete_option('wpfes_email_message');
delete_option('wpfes_double_optin');
delete_option('wpfes_link_credits');
delete_option('wpfes_auto_delete');
delete_option('wpfes_email_ishtml');

delete_option('wpfes_terms_check');
delete_option('wpfes_terms_text');
delete_option('wpfes_terms_link');
delete_option('wpfes_terms_msg');


delete_option('wpfes_msg_bad');
delete_option('wpfes_msg_dbl');
delete_option('wpfes_msg_fail');
delete_option('wpfes_msg_sent');
delete_option('wpfes_dbl_fail');
delete_option('wpfes_dbl_sent');

delete_option('wpfes_form_header');
delete_option('wpfes_form_footer');
delete_option('wpfes_form_email');
//add_option('wpfes_form_fields', "");
delete_option('wpfes_form_fields');
delete_option('wpfes_form_send');

//delete_option('wpfes_link_credits_text');
delete_option('wpfes_smtp_server');
delete_option('wpfes_smtp_port');
delete_option('wpfes_smtp_username');
delete_option('wpfes_smtp_password');

delete_option('wpfes_form_css');


?>