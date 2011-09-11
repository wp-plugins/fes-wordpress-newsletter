<?php
header("Content-type: text/css");
header('Content-Disposition: attachment; filename="wp_fes.js"');
require_once('../../../../wp-load.php');

$form_css = get_option("wpfes_form_css");
echo($form_css);
?>
