<?php

$send_url=get_bloginfo('wpurl').'/wp-content/plugins/'.basename(dirname(dirname(__FILE__))).'/'.basename(dirname(__FILE__)).'/send-mail.php?execute=true';
$email_from = stripslashes(get_option('wpfes_email_from'));

?>
<h3>Compose and send newsletter to subscribers</h3>
<?php
    $url = get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=' . $_GET['page'].'&wpfes-mode=list';
if ($users = $wpdb->get_results("SELECT * FROM $table_users WHERE `msg_sent` = '1' ORDER BY `id` DESC")) {
?>
<style type="text/css">
#mail-table th {
    text-align: left;
    white-space: nowrap;
}
</style>
<script type="text/javascript">
    function UpdateSMTPRowVisibility(){
        if(document.getElementById('servermode-local').checked){
            document.getElementById('server-smtp-row').style.display='none';
        } else {
            document.getElementById('server-smtp-row').style.display='table-row';
        }
    }

    function GetNewsletterServerMode(){
         if(document.getElementById('servermode-local').checked){
            return 'local';
        } else {
            return 'smtp';
        }
    }
</script>
<form action="#" name="new-mail-form" id="new-mail-form" method="post" enctype="multipart/form-data" onsubmit="return CheckFormAcceptable(this);">
<table cellpadding="0" cellspacing="5" border="0" width="100%" id="mail-table">
    <tr>
        <th width="150px">Send from:</th>
        <td><input onclick="UpdateSMTPRowVisibility();" type="radio" name="servermode" id="servermode-local" value="local" checked="checked"><label for="servermode-local">Local default server</label></td>
        <td><input onclick="UpdateSMTPRowVisibility();" type="radio" name="servermode" id="servermode-smtp" value="smtp"><label for="servermode-smtp">Dedicated SMTP server</label>
        </td>
    </tr>
    <tr id="server-smtp-row" style="display: none;">
        <th>SMTP Server configuration:</th>
        <td colspan="2"><table cellpadding="1" cellspacing="0" border="0" style="background-color: #EEEEEE;">
                <tr>
                    <th>Server hostname:</th>
                    <td><input type="text" name="server-hostname" id="server-hostname" maxlength="100" size="40" value="<?php echo(stripslashes(get_option('wpfes_smtp_server'))); ?>" /></td>
                </tr>
                <tr>
                    <th>Server port:</th>
                    <td><input type="text" name="server-port" id="server-port" maxlength="100" size="40" value="25" value="<?php echo(stripslashes(get_option('wpfes_smtp_port'))); ?>" /></td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><input type="text" name="server-username" id="server-username" maxlength="100" size="40" value="<?php echo(stripslashes(get_option('wpfes_smtp_username'))); ?>" /></td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td><input type="password" name="server-password" id="server-password" maxlength="100" size="40" value="<?php echo(stripslashes(get_option('wpfes_smtp_password'))); ?>" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <th>From:</th>
        <td colspan="2"><input type="text" name="mail-from" id="mail-from" value="<?php echo($email_from) ?>" maxlength="100" size="70" /></td>
    </tr>
    <tr>
        <th>Message subject:</th>
        <td colspan="2"><input type="text" name="mail-subject" id="mail-subject" maxlength="100" size="70" /></td>
    </tr>
    <tr>
        <th>Message body:<br /><small>You may use HTML tags</small></th>
        <td colspan="2"><textarea rows="10" cols="70" id="mail-body" name="mail-body"></textarea></td>
    </tr>
    <tr>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td colspan="1"><input type="submit" value="Start sending" id="mail-send" name="mail-send" /></td>
        <td colspan="2"><span id="sending" style="display: none;">Sending ...</span></td>
    </tr>
</table>
    <input type="hidden" name="sendkey" value="EEAA00Q" />
</form>
<?php
}
$table_users = $wpdb->prefix . "wpfes_users";

$users = $wpdb->get_results("SELECT * FROM $table_users WHERE `msg_sent` = '1' ORDER BY `id` DESC");
$max_index=0;
$min_index=200000;

?>
<table border="0" cellpadding="2" cellspacing="3" id="recipients-list" >
    <tr>
        <td colspan="2"><input type="checkbox" name="recipientsall" id="recipientsall" onclick="checkall();" checked="checked" /> <b>Recipients: (<?php echo(count($users)); ?>)</b></td>
    </tr>
    <?php
$col_count=2;
$col_index=0;
foreach ($users as $user) {
//var_dump($user);
    $max_index=max($max_index,$user->id);
    $min_index=min($min_index,$user->id);
    if($col_index % $col_count == 0) { echo('<tr>'); }
    ?>

    
        <td>
            <input type="checkbox" onclick="uncheckMasterAll();" name="recipient<?php echo($user->id); ?>" value="<?php echo($user->id); ?>" id="recipient<?php echo($user->id); ?>" checked="checked" />
            <?php echo($user->email); ?>
        </td>
        <td id="td-recipient-<?php echo($user->id); ?>">&nbsp;</td>
    
 <?php

    if($col_index % $col_count == $col_count-1) { echo('</tr>'); }
    $col_index+=1;

}

    ?></tr>
</table>
<p class="info-tip">For more advanced newsletter sending options, please consider our dedicated product, <a href="http://www.fastemailsender.com/">Fast Email Sender</a>.<br />
By default, CPanel hosted domains have a limitation of 250 emails per hour. If you exceed that, anything over the 250 limit will not be delivered.</p>



<script type="text/javascript" >
    var max_index=<?php echo($max_index); ?>;
    var min_index=<?php echo($min_index); ?>;
    function CheckFormAcceptable(xform){
        wpfes_send_messages(max_index);
        return false;
    }
    
var ignore_error=0;

function uncheckMasterAll(){
    var allChecked=true;

    var index=max_index;
    while(index>=min_index){
        if(document.getElementById('recipient'+index)){
            if(document.getElementById('recipient'+index).checked){
            } else {
                allChecked=false;
            }
        }
        index--;
    }

    document.getElementById('recipientsall').checked=allChecked;
}

function checkall(){
    var chk=document.getElementById('recipientsall').checked;
    var index=max_index;
    while(index>=min_index){
        if(document.getElementById('recipient'+index)){
            document.getElementById('recipient'+index).checked=chk;
        }
        index--;
    }

}


function wpfes_send_messages(index) {
    if((document.getElementById('mail-subject').value=='') || (document.getElementById('mail-body').value=='')){
        alert('Cannot send message with empty body or subject');
    } else {
    document.getElementById('sending').innerHTML='Sending ...';
    document.getElementById('sending').style.display="inline";
var found=false;
while(!found && index>=min_index){
    if(document.getElementById('recipient'+index)){
        if(document.getElementById('recipient'+index).checked){
            found=true;
        } else {
            index--;
        }
    } else {
        index--;
    }

}
if(found) {
	var data = {
		action: 'send_mass_mail',
                security: '<?php echo(wp_create_nonce('1299')); ?>',
		from: document.getElementById('mail-from').value,
		subject: document.getElementById('mail-subject').value,
		content: document.getElementById('mail-body').value,
		hostname: document.getElementById('server-hostname').value,
		port: document.getElementById('server-port').value,
		username: document.getElementById('server-username').value,
		password: document.getElementById('server-password').value,
                local: GetNewsletterServerMode(),
                recipientid: index
	};
        //alert('Rq:'+index);
	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		//alert('Got this from the server: ' + response);
                var poss=response.indexOf(":");
                var result=response.substr(poss+1);
                var recid=response.substr(0,poss);
                document.getElementById('td-recipient-'+recid).innerHTML=result;
                recid=parseInt(recid);
                //alert(recid);
                if(result=='OK') {
                    wpfes_send_messages(recid-1);
                } else {
                    if(ignore_error==0){ //ask user if wants to stop
                        if(confirm('The message was not sent. Do you wish to continue with the other messages?')){
                            ignore_error+=1;
                            wpfes_send_messages(recid-1);
                        } else {
                            ignore_error=-1;
                        }
                    } else if (ignore_error>0){ //just continue, the user said ok
                        wpfes_send_messages(recid-1);
                    } else {
                        //simply quit sending, user wanted to stop
                    }
                    
                }
                wpfes_check_sending_done(recid);
	});
};
}
};

function wpfes_check_sending_done(index){
    if (index<=min_index) {
        document.getElementById('sending').innerHTML='DONE';
    }
}
</script>