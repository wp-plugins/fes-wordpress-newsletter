<?php
$wpfes_flds = (get_option('wpfes_form_fields'));
$terms_check = get_option("wpfes_terms_check");
$terms_text = get_option("wpfes_terms_text");
$terms_link = get_option("wpfes_terms_link");
$terms_msg = get_option("wpfes_terms_msg");

$wpfes_msg_bad = strip_tags(get_option("wpfes_msg_bad"));
$out = '<form action="#wpfesw" method="post" onsubmit="return wpfes_check_form();">' . "\n";
$out .= '<p class="wpfes_form_label">' . get_option('wpfes_form_email');
$out .= '<br /> <input type="text" name="wpfes_email" id="wpfes_email" class="wpfes_form_txt" /></p>' . "\n";
if (is_array($wpfes_flds)) {
    foreach ($wpfes_flds as $wpfes_k => $wpfes_v) {
        if (is_numeric($wpfes_k) && $wpfes_v) {
            if(strpos($wpfes_v,'|')){ //radiobox options
                $vals=explode('|',$wpfes_v);
                $out .= '<p class="wpfes_form_label">' . $vals[0];
                $ii=0;
                for($ii=1;$ii<count($vals);$ii++){
                    $checked='';
                    if($ii==1){
                        $checked=' checked="checked"';
                    }
                    $out .= '<br /><input'.$checked.' type="radio" name="wpfes_fld['. $wpfes_k .']" id="wpfes_fld_'. $wpfes_k.'_'.$ii .'" class="wpfes_form_txt" value='.$vals[$ii].' />'.$vals[$ii] . "\n";
                }
                echo('</p>');
            } else { //normal text box
                $out .= '<p class="wpfes_form_label">' . $wpfes_v.'<br />';
                $out .= ' <input type="text" name="wpfes_fld['. $wpfes_k .']" id="wpfes_fld_'. $wpfes_k .'"  maxlength="64" class="wpfes_form_txt" /></p>' . "\n";
            }
        }
    }
}
$out .= '<script type="text/javascript">
function wpfes_toggle_custom_fields (state) {
    for (i=2; i<16; i++) {
        if (obj = document.getElementById(\'wpfes_fld_\'+i)) {
            obj.disabled = !state;
            obj.readOnly = !state;
        }
    }
}
function wpfes_check_form(){
    var showCheckbox=';
    $out.=$terms_check ? '1' : '0';
	
$out.=';
    if(document.getElementById("wpfes_email").value){
        if(showCheckbox>0){
            if(document.getElementById("wpfes_agree_terms").checked) {
                return true;
            } else {
                alert("'.$terms_msg.'");
                return false;
            }
        } else {
            return true;
        }
    } else {
        alert("'.$wpfes_msg_bad.'");
        return false;
    }

}

function change_newsletter_agreement_visibility(new_state){
    document.getElementById("newsletter-agreement-box").style.display=new_state;
}

function newsletter_check_and_show_agreement() {
    change_newsletter_agreement_visibility("block");
    document.getElementById("wpfes_agree_terms").checked=true;
}
</script>';
$out .= '<p class="wpfes_form_label"><input type="radio" name="wpfes_radio_option" id="wpfes_radio_option1" onclick="wpfes_toggle_custom_fields(1)" class="wpfes_form_radio" value="wpfes_radio_in" checked="checked" /> '.$wpfes_flds['wpfes_radio_in'];
$out .= '<br/>';
$out .= '<input type="radio" name="wpfes_radio_option" id="wpfes_radio_option2" onclick="wpfes_toggle_custom_fields(0)" class="wpfes_form_radio" value="wpfes_radio_out" /> '.$wpfes_flds['wpfes_radio_out'].'</p>';

if($terms_check){
    $out .= '
<p class="wpfes_form_label">
   <input type="checkbox" name="wpfes_agree_terms" id="wpfes_agree_terms" value="1" />
   <span for="wpfes_agree_terms" onclick="newsletter_check_and_show_agreement();" class="tos">'.$terms_link.'</span>
</p>

<div id="newsletter-agreement-box" class="widget-container newsletter-box" style="display: none;">
    <div onclick="change_newsletter_agreement_visibility(\'none\');" class="newsletter-close">&nbsp;X&nbsp;</div>
    <h3 class="widget-title">Newsletter agreement</h3>
    <div id="newsletter-agreement-text">'.$terms_text.'</div>
</div>';
}

$out .= '<p class="wpfes_form_label"><input type="submit" value="' . get_option('wpfes_form_send');
$out .= '" class="wpfes_form_btn" /></p>' . "\n</form>\n<!-- Made by www.fastemailsender.com Newsletter Software -->\n";

?>