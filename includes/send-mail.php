<?php

function wpfes_send_email($from, $to, $subject, $body, $mode='local', $server='', $port='25', $user='', $pass=''){

    $body=str_replace('#unsubscribe#', site_url().'?fes-unsubscribe='.$to, $body);

    if($mode=='local'){
        $headers =  "From: $from\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "Content-Transfer-Encoding: 8bit\r\n";
        $headers .= "Reply-To: $from";

        return mail($to, $subject, stripslashes($body), $headers);
    } else {
        require_once(dirname(__FILE__).'/class.phpmailer.php');
        require_once(dirname(__FILE__).'/class.smtp.php');
    
$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = $server; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Port       = $port;                    // set the SMTP port for the GMAIL server
  $mail->Username   = $user; // SMTP account username
  $mail->Password   = $pass;        // SMTP account password
  $mail->AddReplyTo($from, '');
  $mail->AddAddress($to, '');
  $mail->SetFrom($from, '');
  $mail->AddReplyTo($from, '');
  $mail->Subject = $subject;
  $mail->Body = stripslashes($body);

  $mail->Send();
  return true;
} catch (phpmailerException $e) {
  return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}

    }
}
        
if(check_ajax_referer('1299','security', 'security error') ){

    $table_users = $wpdb->prefix . "wpfes_users";
    $recipient_id=$_POST['recipientid'];

    $users = $wpdb->get_results("SELECT * FROM $table_users WHERE `msg_sent` = '1' and id='$recipient_id'");

    foreach ($users as $user) { //keep for each, though just 1 element max

        $mode=$_POST['local'];
        if($mode=='smtp'){
            $host = stripslashes($_POST['hostname']);
            $port = stripslashes($_POST['port']);
            $username = stripslashes($_POST['username']);
            $pass = stripslashes($_POST['password']);

            update_option('wpfes_smtp_server', $host);
            update_option('wpfes_smtp_port', $port);
            update_option('wpfes_smtp_username', $username);
            update_option('wpfes_smtp_password', $pass);
        }
        
        echo($recipient_id.':');
        $dat=wpfes_send_email($_POST['from'], $user->email, $_POST['subject'], $_POST['content'], $_POST['local'], $_POST['hostname'], $_POST['port'], $_POST['username'], $_POST['password']);
        if($dat===true)
        {
            echo('OK');
        } elseif (strpos($dat, 'Could not connect to SMTP host')) {
            echo('This server (the web host) does not allow connection on port '.$_POST['port'].'. You can only use local mode.<br />');
        } else {
            echo($dat);
        }
    }

} else {
    echo('<h2>Function only available through the admin interface</h2>');
}



?>