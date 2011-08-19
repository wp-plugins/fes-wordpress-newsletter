<?php

function wpfes_opt_in() {
	global $wpdb;
	$table_users = $wpdb->prefix . "wpfes_users";
        $form_css = get_option("wpfes_form_css");
    echo '<div id="wpfes_newsletter">
<div id="wpfes_newsletter_message_box" class="widget-container newsletter-box" style="display: none; height: auto;">
    <h3 class="widget-title">Newsletter subscription status</h3>
    <div class="newsletter-box-text" id="wpfes_newsletter_message"></div>
    <input type="button" onclick="wpfes_newsletter_message_close()" value="OK" />
</div>
<script type="text/javascript">
    function wp_fes_newsletter_status_box_show(boxText){
    document.getElementById("wpfes_newsletter_message").innerHTML=boxText;
    document.getElementById("wpfes_newsletter_message_box").style.display="block";
}
function wpfes_newsletter_message_close(){
    document.getElementById("wpfes_newsletter_message_box").style.display="none";
}
</script>
<style type="text/css">
'.$form_css.'
</style>
';


    $hh= stripslashes(get_option('wpfes_form_header'));
    if(strlen($hh)>0){
        echo('<p>'.$hh.'</p>');
    }

    $_POST['wpfes_email'] = trim($_POST['wpfes_email']);
    if (empty($_POST['wpfes_email'])) {
        if (!empty($_GET['wpfes_d']) && !empty($_GET['wpfes_s'])) {
            wpfes_dbl_optin_confirm();
        }
        else {
            wpfes_show_form();
        }
    } 
    else {
        $email = stripslashes($_POST['wpfes_email']);
        $wpfes_custom_flds = "";
        $wpfes_custom_flds_mail = "";
        if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
            wpfes_echo_message(stripslashes(get_option('wpfes_msg_bad')));
            wpfes_show_form();
        }
        else {
            if ($_POST['wpfes_radio_option'] && $_POST['wpfes_radio_option'] == "wpfes_radio_out") {
                $manager_email = stripslashes(get_option('wpfes_email_from'));
                $wpfes_flds = (get_option('wpfes_form_fields'));
                $headers = "MIME-Version: 1.0\n";
                $headers .= "From: $email\n";
                $headers .= "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";
                if (mail($manager_email, "Unsubscribe", $email, $headers)) {
                        wpfes_echo_message( stripslashes($wpfes_flds['wpfes_unsubscr_success']));
                        // Delete user from database
                        $delete = "DELETE FROM " . $table_users . "
                            WHERE email= '$email'";
                        $result = $wpdb->query($delete);
                } else {
                        wpfes_echo_message( stripslashes(get_option('wpfes_msg_fail')));
                }
            } else {
                $wpfes_double_optin = get_option('wpfes_double_optin');
                $wpfes_auto_delete = get_option('wpfes_auto_delete');
                if (!empty($_POST['wpfes_fld'])) {
                    
                    foreach ($_POST['wpfes_fld'] as $wpfes_k => $wpfes_v) {
                        if (ereg("^[ ]*([^\t\r\n\\]{1,64}[^ ])[ ]*$", stripslashes($wpfes_v), $wpfes_r)) {
                            $wpfes_custom_flds .= "#".$wpfes_k."#: ".$wpfes_r[1]."\n";
                            $xkey=$wpfes_flds[$wpfes_k];
                            if(strpos($xkey,'|')){ //radiobox options
                                $xkey=explode('|',$xkey);
                                $xkey=$xkey[0];
                            }
                            $wpfes_custom_flds_mail .= $xkey.": ".$wpfes_r[1]."\n";
                        }
                    }
                }
                $email_from = stripslashes(get_option('wpfes_email_from'));
                $subject = stripslashes(get_option('wpfes_email_subject'));
                $message = stripslashes(get_option('wpfes_email_message'));

                $headers = "MIME-Version: 1.0\n";
                $headers .= "From: $email_from\n";
                $headers .= "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";

                $wpfes_time = time();
                $wpfes_ip = wpfes_getip();
                if ($wpfes_double_optin == 1) {
                    $wpfes_link = Array ("scheme" => "http", "host" => $_SERVER['HTTP_HOST'], "port" => "", "user" => "", "pass" => "", "path" => "", "query" => "", "fragment" => "");
                    $wpfes_link += parse_url(get_bloginfo('wpurl'));
                    $wpfes_optin_url = $wpfes_link['scheme']."://".$wpfes_link['host'].$_SERVER['SCRIPT_NAME']."?wpfes_d=".$wpfes_time."&wpfes_s=".md5($email.$wpfes_ip)."#wpfesw";
                    $message = str_replace('#link#', $wpfes_optin_url, $message);
                }
                $selectqry = "SELECT * FROM " . $table_users . " WHERE `email` = '" . $email ."'";
                if ($wpdb->query($selectqry)) {
                    wpfes_echo_message( stripslashes(get_option('wpfes_msg_dbl')));
                }
                else {
                    if (mail($email,$subject,$message,$headers)) {
                        if ($wpfes_double_optin || !$wpfes_auto_delete) {
                            // Write new user to database
                            $insert = "INSERT INTO " . $table_users . " 
                                (time, ip, email, msg_sent, custom_data) 
                                VALUES (
                                '" . $wpfes_time . "',
                                '" . $wpfes_ip . "',
                                '" . $email . "',
                                '" . (int) !$wpfes_double_optin ."',
                                '" . $wpfes_custom_flds . "'
                                )";
                            $result = $wpdb->query($insert);
                        }
                        if (!$wpfes_double_optin) { //send message to admin, to add to the subscription list in dedicated software
                            $headers = "MIME-Version: 1.0\n";
                            $headers .= "From: $email\n";
                            $headers .= "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";
                            mail($email_from, "Subscribe", $wpfes_custom_flds_mail, $headers);
                        }
                        wpfes_echo_message( stripslashes(get_option('wpfes_msg_sent')));
                    } else {
                        wpfes_echo_message( stripslashes(get_option('wpfes_msg_fail')));
                    }
                }
            }
        }
    }
    echo '<p>'.stripslashes(get_option('wpfes_form_footer')).'</p>';
    $add_link_lv = get_option("wpfes_link_credits");
    $out .= '<h6 ';
if ($add_link_lv) {
} else {
    $out .= 'class="wpfes_off"';
}
$out .= '>'.get_option('wpfes_link_credits_text').'</h6>';
    echo $out;
	echo '</div>';
}

function wpfes_dbl_optin_confirm() {
	global $wpdb;
	$table_users = $wpdb->prefix . "wpfes_users";
	$email = stripslashes(get_option('wpfes_email_from'));
	$wpfes_auto_delete = get_option('wpfes_auto_delete');
	$sql = "SELECT * FROM `". $table_users . "` WHERE `time` = '" . $_GET['wpfes_d'] . "' AND MD5(CONCAT(`email`, `ip`)) = '" . $_GET['wpfes_s'] ."' AND `msg_sent` = '0'";
	$res = $wpdb->get_results($sql);
	if (sizeof($res)) {
		$record = $res[0];
		$headers = "MIME-Version: 1.0\n";
		$headers .= "From: ". $record->email."\n";
		$headers .= "Content-Type: text/plain; charset=\"" . get_settings('blog_charset') . "\"\n";
                
                $fields=$record->custom_data;
                $wpfes_flds = (get_option('wpfes_form_fields'));
                $i=0;
                for($i=1;$i<=15;$i++){
                    $xkey=$wpfes_flds[$i];
                    if(strpos($xkey,'|')){ //radiobox options
                        $xkey=explode('|',$xkey);
                        $xkey=$xkey[0];
                    }
                    $fields=str_replace('#'.$i.'#', $xkey, $fields);
                }
                $fields=str_replace('::', ':', $fields); //just in case
                
		if (mail($email, stripslashes(get_option('wpfes_email_subject'))." - New subscriber", $fields, $headers)) {
			if ($wpfes_auto_delete) {
				$update = "DELETE FROM `$table_users` WHERE `id` = ". $record->id;
			}
			else {
				$update = "UPDATE `$table_users` SET `msg_sent` = '1' WHERE `id` = ". $record->id;
			}
			$res = $wpdb->query($update);
			wpfes_echo_message( stripslashes(get_option('wpfes_dbl_sent')));
		}
		else {
			wpfes_echo_message( stripslashes(get_option('wpfes_msg_fail')));
		}
	}
	else {
		wpfes_echo_message( stripslashes(get_option('wpfes_dbl_fail')));
	}
}

?>