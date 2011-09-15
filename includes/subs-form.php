<?php
$wpfes_flds = (get_option('wpfes_form_fields'));
$terms_check = get_option("wpfes_terms_check");
$terms_text = get_option("wpfes_terms_text");
$terms_link = get_option("wpfes_terms_link");
$terms_msg = get_option("wpfes_terms_msg");

$wpfes_msg_bad = strip_tags(get_option("wpfes_msg_bad"));
$wpfes_from_email = get_option('wpfes_form_email');
$out .= '<div id="wpfes_newsletter"><form action="#wpfesw" method="post" onsubmit="return wpfes_check_form();">' . "\n";
$out .= '<p class="wpfes_form_label"><input type="text" name="wpfes_email" id="wpfes_email" class="wpfes_form_txt" onblur="if (this.value==\'\') this.value=this.defaultValue" onclick="if (this.defaultValue==this.value) this.value=\'\'" value="'.$wpfes_from_email.'" /></p>' . "\n";
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
                $out .= '<p class="wpfes_form_label"><input type="text" name="wpfes_fld['. $wpfes_k .']" id="wpfes_fld_'. $wpfes_k .'"  maxlength="64" class="wpfes_form_txt"onblur="if (this.value==\'\') this.value=this.defaultValue" onclick="if (this.defaultValue==this.value) this.value=\'\'" value="'.$wpfes_v.'" /></p>' . "\n";
            }
        }
    }
}

$out .= '<p class="wpfes_form_label" style="display:none;"><input type="radio" name="wpfes_radio_option" id="wpfes_radio_option1" onclick="wpfes_toggle_custom_fields(1)" class="wpfes_form_radio" value="wpfes_radio_in" checked="checked" /> <label for="wpfes_radio_option1">'.$wpfes_flds['wpfes_radio_in'].'</label>';
$out .= '<br/>';
$out .= '<input type="radio" name="wpfes_radio_option" id="wpfes_radio_option2" onclick="wpfes_toggle_custom_fields(0)" class="wpfes_form_radio" value="wpfes_radio_out" /> <label for="wpfes_radio_option2">'.$wpfes_flds['wpfes_radio_out'].'</label></p>';

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

$add_link_lv = get_option("wpfes_link_credits");
    $out .= '<h6 ';
if ($add_link_lv) {
} else {
    $out .= 'class="wpfes_off"';
}
$out .= '>'.get_option('wpfes_link_credits_text').'</h6>';
$out .= '</div>';
?>