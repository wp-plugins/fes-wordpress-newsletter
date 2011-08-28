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
<style type="text/css">
    .row-even {
        background-color: #FFF;
    }
    .row-odd {
        background-color: #eee;
}
table tr.row-header td {
    color: #FFF;
    background-color: #000;
	font-size:16px!important;
	font-style:italic;
	padding:3px;
}
table tr th {
	font-weight:normal;
	text-align:right;
	padding:0 5px 0 0;
}
.info-tip {
    padding-left: 40px;
    background-repeat: no-repeat;
    background-image: url('../wp-content/plugins/fes-wordpress-newsletter/includes/info-tip.png');
    background-position: left middle;
    line-height:28px;
	margin:5px 0;
}
.float-left {
    float: left;
    clear: right;
}
#fes-newsletter-top-menu {
	list-style:none;
	list-style-position: outside;
	clear: both;
	margin:10px 0 10px 0;
	float:left;
}

#fes-newsletter-top-menu li {
	display: block;
	height: 40px;
	margin-right: 100px;
	
	line-height: 40px;
	float: left;
	font-size: large;
}
#fes-newsletter-top-menu li a{
	text-decoration: underline;
	color:#464646;
}
#fes-newsletter-top-menu li a.fes-menu-li-notactive {
	color:#21759B;
}
.fes-menu-li-opt {
	background-position:-435px -5px;
}
.fes-menu-li-users {
	background-position:-598px -5px;
}
.fes-menu-li-mail {
	background-position:-71px -5px;
}

.fes-menu-li-opt, .fes-menu-li-users, .fes-menu-li-mail {
	background-image: url('images/icons32.png');
	display: inline-block;
	width: 40px;
	height: 40px;
}
.fes-menu-li-opt span {
	line-height: normal;	
}
.fes-menu-li-notactive {
	/*font-weigh: bold !important;*/
	text-decoration: none !important;
}
table, caption, tbody, tfoot, thead, tr, th, td {
    background: inherit;
}
.clear {
	clear:both;
}
h3 {
	color: #FFF;
    background-color: #000;
	font-size:16px!important;
	font-style:italic;
	padding:3px;
	font-weight:normal;
	margin:0 0 10px;
}
</style>
<script type="text/javascript">
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
</script>
<ul id="fes-newsletter-top-menu">
<li><a class="<?php echo($active_link!='options' ? 'fes-menu-li-notactive' : ''); ?>" href="<?php echo($main_path); ?>options"><span class="fes-menu-li-opt">&nbsp</span>Options</a></li>
<li><a class="<?php echo($active_link!='list' ? 'fes-menu-li-notactive' : ''); ?>" href="<?php echo($main_path); ?>list"><span class="fes-menu-li-users ">&nbsp</span>Subscribed users</a></li>
<li><a class="<?php echo($active_link!='new-mail' ? 'fes-menu-li-notactive' : ''); ?>" href="<?php echo($main_path); ?>new-mail"><span class="fes-menu-li-mail ">&nbsp</span>Send newsletter</a></li>
</ul>
<div class="clear"></div>
<?php	
}

?>