<form method="post" action="">
    <table width="100%" cellspacing="2" cellpadding="5" class="optiontable editform" id="options-table">
    <tr class="row-header"><td colspan="2">General settings</td></tr>
      <tr>
        <th scope="row">Email where you will get notified:</th>
        <td>           
	    <input type="hidden" name="wpfes_hidden" value="SAb13c" />
            <input type="text" name="wpfes_email_from" id="wpfes_email_from" value="<?php echo $email_from; ?>" size="80" />
        </td>
      </tr>
      <tr>
        <th scope="row">Double Opt-in:</th>
        <td>
          <input type="checkbox" name="wpfes_double_optin" id="wpfes_double_optin" value="1"<?php echo $double_optin ? " checked=\"checked\"" : "";?> />
          If checked you will receive subscribing emails only when user clicks 
          on the appropriate link inside confirmation message.</td>
      </tr>
      <tr> 
        <th scope="row">Message to subscriber<br />SUBJECT:</th>
        <td> 
            <input type="text" name="wpfes_email_subject" id="wpfes_email_subject" value="<?php echo $email_subject; ?>" size="80" maxlength="100" />
        </td>
      </tr>
      <tr>
        <th scope="row">Message to subscriber<br />BODY:</th>
        <td> 
          <p> 
            <textarea name="wpfes_email_message" id="wpfes_email_message" rows="6" cols="70"><?php echo $email_message; ?></textarea>
          </p>
          <p class="info-tip"><strong>SUBJECT</strong> and <strong>BODY</strong> fields are required only if <strong>Double Opt-in</strong> is checked.<br /><small>Use the <i>#link#</i> placeholder in BODY field where you want the URL for confirming
            subscription to appear.</small> </p>
        </td>
      </tr>
      <!--tr>
        <th scope="row">Is message in HTML?</th>
        <td>
            <input type="checkbox" name="wpfes_email_ishtml" id="wpfes_email_ishtml" value="1"<?php echo $email_ishtml ? " checked=\"checked\"" : "";?> />
            If checked the subscriber will receive the welcoming email as HTML.
              HTML emails allow text formating and images, but they are larger in size than text-only emails.
          
         </td>
      </tr-->
      <!--tr>
        <th scope="row">Delete subscribed users:</th>
        <td>
          <input type="checkbox" name="wpfes_auto_delete" id="wpfes_auto_delete" value="1"<?php echo $auto_delete ? " checked=\"checked\"" : "";?> />
          If checked automatically removes users upon their subscription (use 
          only if you download your subscriptions daily)</td>
      </tr-->

    <tr class="row-header"><td colspan="2">Front side messages</td></tr>
      <tr> 
        <th scope="row">Message if email address is not valid:</th>
        <td> 
          <input type="text" name="wpfes_msg_bad" id="wpfes_msg_bad" value="<?php echo $msg_bad; ?>" size="80" />
        </td>
      </tr>
      <tr>
        <th scope="row">Message if email address is duplicate:</th>
        <td>
          <input type="text" name="wpfes_msg_dbl" id="wpfes_msg_dbl" value="<?php echo $msg_dbl; ?>" size="80" />
        </td>
      </tr>
      <tr> 
        <th scope="row">Failed to send:</th>
        <td> 
          <input type="text" name="wpfes_msg_fail" id="wpfes_msg_fail" value="<?php echo $msg_fail; ?>" size="80" />
        </td>
      </tr>
      <tr>
        <th scope="row">Subscribe message:</th>
        <td> 
          <input type="text" name="wpfes_msg_sent" id="wpfes_msg_sent" value="<?php echo $msg_sent; ?>" size="80" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Unsubscribe message:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[wpfes_unsubscr_success]" id="wpfes_unsubscr_success" value="<?php echo $form_fields['wpfes_unsubscr_success']; ?>" size="80" />
        </td>
      </tr>
      <tr> 
        <th scope="row">Double opt-in failure:</th>
        <td>
          <input type="text" name="wpfes_dbl_fail" id="wpfes_dbl_fail" value="<?php echo $dbl_fail; ?>" size="80" />
        </td>
      </tr>
      <tr> 
        <th scope="row">Double opt-in success:</th>
        <td>
          <input type="text" name="wpfes_dbl_sent" id="wpfes_dbl_sent" value="<?php echo $dbl_sent; ?>" size="80" />
        </td>
      </tr>
      <tr>
        <th scope="row">Terms and conditions</th>
        <td> 
            <input type="checkbox" name="wpfes_terms_check" id="wpfes_terms_check" value="1"<?php echo $terms_check ? " checked=\"checked\"" : "";?> /> <label for="wpfes_terms_check">Activate agreement link:</label><br />
                <input type="text" name="wpfes_terms_link" id="wpfes_terms_link" value="<?php echo $terms_link; ?>" size="80" /><br />
                Terms and conditions text:<br />
                <textarea rows="5" cols="70" name="wpfes_terms_text"><?php echo $terms_text ?></textarea><br />
                Message if not checked<br />
                <input type="text" name="wpfes_terms_msg" id="wpfes_terms_msg" value="<?php echo $terms_msg; ?>" size="80" />
        </td>
      </tr>

    <tr class="row-header"><td colspan="2">Front side form appearance and labels</td></tr>
      <tr> 
        <th scope="row">Form header:</th>
        <td>
          <textarea name="wpfes_form_header" id="wpfes_form_header" rows="4" cols="70"><?php echo $form_header; ?></textarea>
        </td>
      </tr>
      <tr> 
        <th scope="row">Form footer:</th>
        <td> 
          <textarea name="wpfes_form_footer" id="wpfes_form_footer" rows="2" cols="70"><?php echo $form_footer; ?></textarea>
        </td>
      </tr>
      <tr> 
        <th scope="row">E-mail field #1 (*)</th>
        <td> <br /><br /><input type="text" name="wpfes_form_email" id="wpfes_form_email" value="<?php echo $form_email; ?>" size="40" maxlength="64" />
        <p class="info-tip"><small>E-mail filed is mandatory and cannot be removed, just renamed.</small></p>
            </td>
      </tr>
      <tr> 
        <th scope="row">Custom field #2:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[2]" id="wpfes_form_fld2" value="<?php echo $form_fields[2]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #3:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[3]" id="wpfes_form_fld3" value="<?php echo $form_fields[3]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #4:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[4]" id="wpfes_form_fld4" value="<?php echo $form_fields[4]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #5:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[5]" id="wpfes_form_fld5" value="<?php echo $form_fields[5]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #6:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[6]" id="wpfes_form_fld6" value="<?php echo $form_fields[6]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #7:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[7]" id="wpfes_form_fld7" value="<?php echo $form_fields[7]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #8:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[8]" id="wpfes_form_fld8" value="<?php echo $form_fields[8]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #9:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[9]" id="wpfes_form_fld9" value="<?php echo $form_fields[9]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #10:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[10]" id="wpfes_form_fld10" value="<?php echo $form_fields[10]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #11:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[11]" id="wpfes_form_fld11" value="<?php echo $form_fields[11]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #12:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[12]" id="wpfes_form_fld12" value="<?php echo $form_fields[12]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #13:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[13]" id="wpfes_form_fld13" value="<?php echo $form_fields[13]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #14:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[14]" id="wpfes_form_fld14" value="<?php echo $form_fields[14]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Custom field #15:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[15]" id="wpfes_form_fld15" value="<?php echo $form_fields[15]; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr>
        <th scope="row">&nbsp;</th>
        <td><p class="info-tip">Leave blank to <strong>disable</strong> other custom fields. Writing label names will <strong>enable</strong> the custom fields.</p>
            <p class="info-tip">To create radioboxes instead of textboxes, use the | character to split the field name and values. <small>Example: <b>Gender|Man|Woman</b></small></p>
        </td>
      </tr>
	  <tr> 
        <th scope="row">Subscribe label:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[wpfes_radio_in]" id="wpfes_form_fld16" value="<?php echo $form_fields['wpfes_radio_in']; ?>" size="40" maxlength="64" />
        </td>
      </tr>
	  <tr> 
        <th scope="row">Unsubscribe label:</th>
        <td> 
          <input type="text" name="wpfes_form_fld[wpfes_radio_out]" id="wpfes_form_fld17" value="<?php echo $form_fields['wpfes_radio_out']; ?>" size="40" maxlength="64" />
        </td>
      </tr>
      <tr> 
        <th scope="row">Submit button:</th>
        <td> 
          <input type="text" name="wpfes_form_send" id="wpfes_form_send" value="<?php echo $form_send; ?>" size="40" maxlength="64" />
        </td>
      </tr>
      <tr>
        <th scope="row">Credits:</th>
        <td> 
          <input type="checkbox" name="wpfes_link_credits" id="wpfes_link_credits" value="1"<?php echo $link_credits ? " checked=\"checked\"" : "";?> /> <label for="wpfes_link_credits">If unchecked display off plugin credits from sidebar.</label></td>
      </tr>
      <tr>
        <th scope="row">Custom CSS layout:</th>
        <td>
          <textarea name="wpfes_form_css" id="wpfes_form_css" rows="7" cols="70"><?php echo $form_css; ?></textarea>
        </td>
      </tr>
      <tr> 
        <td colspan="2" scope="row">&nbsp;</td>
      </tr>
    </table>

<p class="submit">
<input type="submit" name="Submit" value="Update Options &raquo;" />
</p>
</form>
<script type="text/javascript">
alternate_table_rows('options-table');
</script>
<p class="info-tip"><strong>How to display newsletter plugin in pages or posts ?</strong> <br />Insert this shortcode <code>&#91;wpfes_opt_in_form&#93;</code> in the content of any pages or posts.</p>