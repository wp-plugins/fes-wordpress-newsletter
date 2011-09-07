<?php
header("Content-type: text/javascript");
header('Content-Disposition: attachment; filename="wp_fes.js"');
    require_once('../../../../wp-load.php');

$terms_text = get_option("wpfes_terms_text");
$terms_link = get_option("wpfes_terms_link");

$terms_check = get_option("wpfes_terms_check");
$terms_msg = get_option("wpfes_terms_msg");
$wpfes_msg_bad = strip_tags(get_option("wpfes_msg_bad"));

?>
function alternate_table_rows(id){
   if(document.getElementsByTagName){
     var table = document.getElementById(id);
     var rows = table.getElementsByTagName("tr");
     var index=0;
     for(i = 0; i < rows.length; i++){
   //manipulate rows
       if(rows[i].className != "row-header"){
           if(index % 2 == 0) {
             rows[i].className = "row-even";
           } else {
             rows[i].className = "row-odd";
           }
           index+=1;
       }
     }
   }
 }

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

function wp_fes_newsletter_status_box_show(boxText){
    document.getElementById("wpfes_newsletter_message").innerHTML=boxText;
    document.getElementById("wpfes_newsletter_message_box").style.display="block";
}
function wpfes_newsletter_message_close(){
    document.getElementById("wpfes_newsletter_message_box").style.display="none";
}

function change_newsletter_agreement_visibility(new_state){
    document.getElementById("newsletter-agreement-box").style.display=new_state;
}

function newsletter_check_and_show_agreement() {
    change_newsletter_agreement_visibility("block");
    document.getElementById("wpfes_agree_terms").checked=true;
}
function wpfes_toggle_custom_fields (state) {
    for (i=2; i<16; i++) {
        if (obj = document.getElementById('wpfes_fld_'+i)) {
            obj.disabled = !state;
            obj.readOnly = !state;
        }
    }
}

////////////////////////////////////////////////////////


function wpfes_check_form(){
    var showCheckbox=<?php echo($terms_check ? '1' : '0'); ?>
	

    if(document.getElementById("wpfes_email").value){
        if(showCheckbox>0){
            if(document.getElementById("wpfes_agree_terms").checked) {
                return true;
            } else {
                alert("<?php echo($terms_msg); ?>");
                return false;
            }
        } else {
            return true;
        }
    } else {
        alert("<?php echo($wpfes_msg_bad); ?>");
        return false;
    }

}




 
////////////////////////////////////////////////////////
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

function wpfes_check_sending_done(index){
    if (index<=min_index) {
        document.getElementById('sending').innerHTML='DONE';
    }
}