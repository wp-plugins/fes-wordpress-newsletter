<?php

if(!isset($_GET['wpfes-mode'])){
	$_GET['wpfes-mode']='options';
}

function wpfes_echo_header(){
	global $wpfes_install_folder;
	global $wpfes_install_filename;
	$main_path='options-general.php?page='.$wpfes_install_folder.'/'.$wpfes_install_filename.'&wpfes-mode=';
	$active_link=$_GET['wpfes-mode'];
?>



<ul id="fes-newsletter-top-menu">
<li><a class="<?php echo($active_link!='options' ? 'fes-menu-li-notactive' : ''); ?>" href="<?php echo($main_path); ?>options"><span class="fes-menu-li-opt">&nbsp</span>Options</a></li>
<li><a class="<?php echo($active_link!='list' ? 'fes-menu-li-notactive' : ''); ?>" href="<?php echo($main_path); ?>list"><span class="fes-menu-li-users ">&nbsp</span>Subscribed users</a></li>
<li><a class="<?php echo($active_link!='new-mail' ? 'fes-menu-li-notactive' : ''); ?>" href="<?php echo($main_path); ?>new-mail"><span class="fes-menu-li-mail ">&nbsp</span>Send newsletter</a></li>
</ul>
<div class="clear"></div>
<?php	
}

?>