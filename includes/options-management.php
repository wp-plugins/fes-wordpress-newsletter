<?php
// Handle options from get method information
	if (isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];

		// Delete user from database
		$delete = "DELETE FROM " . $table_users .
				" WHERE id = '" . $user_id . "'";
		$result = $wpdb->query($delete);

		// Notify admin of delete
		echo '<div id="message" class="updated fade"><p><strong>';
		_e('User deleted.', 'wpfes_domain');
		echo '</strong></p></div>';
	}
	
	if (isset($_GET['purge'])) {
		$goOn = false;
		switch (intval($_GET['purge'])) {
			case 1:
				// all
				$to_del = "1";
				$goOn = true;
				break;
			case 2:
				// older than 1 week
				$to_del = "`time` < " . strtotime("-1 week");
				$goOn = true;
				break;
			case 3:
				// older than 2 weeks
				$to_del = "`time` < " . strtotime("-2 weeks");
				$goOn = true;
				break;
			case 4:
				// older than 1 month
				$to_del = "`time` < " . strtotime("-1 month");
				$goOn = true;
				break;
		}
		if ($goOn) {
			// Delete user from database
			$delete = "DELETE FROM `" . $table_users .
					"` WHERE " . $to_del . " AND `msg_sent` = '0'";
			$result = $wpdb->query($delete);
	
			// Notify admin of delete
			echo '<div id="message" class="updated fade"><p><strong>';
			_e($result .' user(s) deleted.', 'wpfes_domain');
			echo '</strong></p></div>';
		}
	}

	// Get current options from database
	$email_from = stripslashes(get_option('wpfes_email_from'));
	$email_subject = stripslashes(get_option('wpfes_email_subject'));
	$email_message = stripslashes(get_option('wpfes_email_message'));
	$email_ishtml = stripslashes(get_option('wpfes_email_ishtml'));
        
	$terms_check = stripslashes(get_option('wpfes_terms_check'));
	$terms_text = stripslashes(get_option('wpfes_terms_text'));
	$terms_link = stripslashes(get_option('wpfes_terms_link'));
	$terms_msg = stripslashes(get_option('wpfes_terms_msg'));

	$double_optin = get_option('wpfes_double_optin');
	$link_credits = get_option('wpfes_link_credits');
	$auto_delete = get_option('wpfes_auto_delete');
	$msg_bad = stripslashes(get_option('wpfes_msg_bad'));
	$msg_dbl = stripslashes(get_option('wpfes_msg_dbl'));
	$msg_fail = stripslashes(get_option('wpfes_msg_fail'));
	$msg_sent = stripslashes(get_option('wpfes_msg_sent'));
	$dbl_fail = stripslashes(get_option('wpfes_dbl_fail'));
	$dbl_sent = stripslashes(get_option('wpfes_dbl_sent'));
        
	$form_header = stripslashes(get_option('wpfes_form_header'));
	$form_footer = stripslashes(get_option('wpfes_form_footer'));
	$form_email = stripslashes(get_option('wpfes_form_email'));
	$form_fields = (get_option('wpfes_form_fields'));
	$form_send = stripslashes(get_option('wpfes_form_send'));
	$form_css = stripslashes(get_option('wpfes_form_css'));

	// Update options if user posted new information
	if( $_POST['wpfes_hidden'] == 'SAb13c' ) {
		// Read from form

		$email_from = stripslashes($_POST['wpfes_email_from']);
		$email_subject = stripslashes($_POST['wpfes_email_subject']);
		$email_message = stripslashes($_POST['wpfes_email_message']);
		$email_ishtml = stripslashes($_POST['wpfes_email_ishtml']);

		$terms_check = stripslashes($_POST['wpfes_terms_check']);
		$terms_text = stripslashes($_POST['wpfes_terms_text']);
		$terms_link = stripslashes($_POST['wpfes_terms_link']);
		$terms_msg = stripslashes($_POST['wpfes_terms_msg']);
                
		$double_optin = (int) isset($_POST['wpfes_double_optin']);
		$link_credits = (int) isset($_POST['wpfes_link_credits']);
		$auto_delete = (int) isset($_POST['wpfes_auto_delete']);
		$msg_bad = stripslashes($_POST['wpfes_msg_bad']);
		$msg_dbl = stripslashes($_POST['wpfes_msg_dbl']);
		$msg_fail = stripslashes($_POST['wpfes_msg_fail']);
		$msg_sent = stripslashes($_POST['wpfes_msg_sent']);
		$dbl_fail = stripslashes($_POST['wpfes_dbl_fail']);
		$dbl_sent = stripslashes($_POST['wpfes_dbl_sent']);

		$form_header = stripslashes($_POST['wpfes_form_header']);
		$form_footer = stripslashes($_POST['wpfes_form_footer']);
		$form_email = stripslashes($_POST['wpfes_form_email']);
		$form_fields = is_array($_POST['wpfes_form_fld']) ? $_POST['wpfes_form_fld'] : array();
		$form_send = stripslashes($_POST['wpfes_form_send']);
		$form_css = stripslashes($_POST['wpfes_form_css']);

		// Save to database
		update_option('wpfes_email_from', $email_from );
		update_option('wpfes_email_subject', $email_subject);
		update_option('wpfes_email_message', $email_message);
		update_option('wpfes_double_optin', $double_optin);
		update_option('wpfes_link_credits', $link_credits);
		update_option('wpfes_auto_delete', $auto_delete);

		update_option('wpfes_terms_check', $terms_check);
		update_option('wpfes_terms_text', $terms_text);
		update_option('wpfes_terms_link', $terms_link);
		update_option('wpfes_terms_msg', $terms_msg);
		update_option('wpfes_email_ishtml', $email_ishtml);

		update_option('wpfes_msg_bad', $msg_bad);
		update_option('wpfes_msg_dbl', $msg_dbl);
		update_option('wpfes_msg_fail', $msg_fail);
		update_option('wpfes_msg_sent', $msg_sent);
		update_option('wpfes_dbl_fail', $dbl_fail);
		update_option('wpfes_dbl_sent', $dbl_sent);

		update_option('wpfes_form_header', $form_header);
		update_option('wpfes_form_footer', $form_footer);
		update_option('wpfes_form_email', $form_email);
		update_option('wpfes_form_fields', ($form_fields));
		update_option('wpfes_form_send', $form_send);


		update_option('wpfes_form_css', $form_css);

		// Notify admin of change
		echo '<div id="message" class="updated fade"><p><strong>';
		_e('Options saved.', 'wpfes_domain');
		echo '</strong></p></div>';
	}
?>