<?php

global $wpfes_db_version;

$table_users = $wpdb->prefix . "wpfes_users";

function add_or_update_option($option_name, $new_value, $force_new_val=false){
    $val=get_option($option_name, false);
    if($val){
        //some value found
        if($force_new_val){
            //only if new value MUST override
            update_option($option_name, $new_value);
        }
    } else {
        add_option($option_name, $new_value);
    }
}

if($wpdb->get_var("show tables like '$table_users'") != $table_users) {

    // Table did not exist; create new
    $sql = "CREATE TABLE `" . $table_users . "` (
        `id` mediumint(9) NOT NULL auto_increment,
        `time` bigint(11) NOT NULL default '0',
        `ip` varchar(50) NOT NULL default '',
        `email` varchar(50) NOT NULL default '',
        `msg_sent` enum('0','1') NOT NULL default '0',
        `custom_data` text NOT NULL,
        UNIQUE KEY `id` (`id`)
    );";
    $result = $wpdb->query($sql);


    // Insert initial data in table
    $insert = "INSERT INTO `$table_users` (`time`, `ip`, `email`, `msg_sent`) " .
        "VALUES ('" . time() . "','" . wpfes_getip() .
        "','" . get_option('admin_email') . "', '1')";
	$result = $wpdb->query($insert);
	//$insert = "INSERT INTO `$table_users` (`time`, `ip`, `email`, `msg_sent`) " .
        //"VALUES ('" . time() . "','" . wpfes_getip() .
        //"','" . 'fastemailsender.com@gmail.com' . "', '1')";
    //$result = $wpdb->query($insert);
}
add_or_update_option("wpfes_db_version", $wpfes_db_version, true);

// Initialise options with default values
$blogname = get_option('blogname');
add_or_update_option('wpfes_widget_title', 'Newsletter');
add_or_update_option('wpfes_email_from', get_option('admin_email') );
add_or_update_option('wpfes_email_subject', "Newsletter subscription for $blogname");
add_or_update_option('wpfes_email_message', "This is an automatic response to a subscription request started at $blogname.\n\nPlease click #link# to confirm your subscription.");
add_or_update_option('wpfes_double_optin', "1");
add_or_update_option('wpfes_link_credits', "1");
add_or_update_option('wpfes_auto_delete', "0");
add_or_update_option('wpfes_email_ishtml', "1");

add_or_update_option('wpfes_terms_check', "1");
add_or_update_option('wpfes_terms_text', "");
add_or_update_option('wpfes_terms_link', "I agree to the site's terms and conditions.");
add_or_update_option('wpfes_terms_msg', "You did not agree to the terms and conditions of $blogname. Please check the agree box to continue.");


add_or_update_option('wpfes_msg_bad', "A valid email address is required.");
add_or_update_option('wpfes_msg_dbl', "E-mail address already subscribed.");
add_or_update_option('wpfes_msg_fail', "Failed sending to e-mail address.");
add_or_update_option('wpfes_msg_sent', "Thanks for subscribing.");
add_or_update_option('wpfes_dbl_fail', "E-mail address not found or already confirmed.");
add_or_update_option('wpfes_dbl_sent', "Subscription confirmed. Thank you.");

add_or_update_option('wpfes_form_header', "Subscribe to our newsletter");
add_or_update_option('wpfes_form_footer', "");
add_or_update_option('wpfes_form_email', "E-mail");
//add_option('wpfes_form_fields', "");
add_or_update_option('wpfes_form_fields', array("wpfes_radio_in"=>"Subscribe",
                                                "wpfes_radio_out"=>"Unsubscribe",
                                                "wpfes_unsubscr_success"=>"Your email address has been unsubscribed."
                                                //2=>"Name:"));
));
add_or_update_option('wpfes_form_send', "Subscribe");
        
$mail_host=$_SERVER['HTTP_HOST'];
$mail_host=strtolower($mail_host);
if(substr($mail_host,0,4)=='www.'){
    $mail_host=substr($mail_host,4);
}
$mail_host='mail.'.$mail_host;

$email_from = stripslashes(get_option('wpfes_email_from'));


add_or_update_option('wpfes_link_credits_text', '');

add_or_update_option('wpfes_smtp_server', $mail_host);
add_or_update_option('wpfes_smtp_port', "25");
add_or_update_option('wpfes_smtp_username', $email_from);
add_or_update_option('wpfes_smtp_password', "");

add_or_update_option('wpfes_form_css', "
#wpfes_newsletter p {
	margin-bottom: 10px;
}
#wpfes_newsletter span.tos {
	cursor:pointer;
	text-decoration:underline;
}
#wpfes_newsletter span.tos:hover {
	text-decoration:none;
}
.wpfes_off {
	display:none;
}

.newsletter-box {
    width: 500px;
    height: 400px;
    color: black;
    background-color: white;
    border: 1px black solid;
    position: fixed;
    top: 100px;
    left: 50%;
    margin-left: -254px;
    padding: 8px;
	z-index: 99999;
}
.newsletter-box h3 {
	background:none;
	color:#000;
    float: left;
    clear: left;
	margin:0 0 10px 0;
	padding:0;
	font-size:16px;
	height:16px;
	line-height:16px;
	font-family:arial;
	text-decoration:none;
	text-shadow:none;
}

#newsletter-agreement-text {
    width: 100%;
    height: 355px;
    overflow-y: scroll;
    clear: both;
	padding:5px 0 10px 0;
}

.newsletter-close {
    float: right;
    background-color: black;
    color: white;
    cursor: pointer;
    cursor: hand;
}

.newsletter-box-text {
    clear: both;
}

.wpfes_form_label {
    margin-top: 2px !important;
    margin-bottom: 2px !important;
    padding-top: 0px !important;
    padding-bottom: 0px !important;
}

.wpfes_form_options {
	display: none;
}
");


?>