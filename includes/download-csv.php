<?php
        
if(strpos($_SERVER['HTTP_REFERER'],'wp-admin/options-general.php?page=fes-wordpress/newsletter/wpfes-opt-in.php')){
    header("Content-Type: application/csv");
    header("Content-Disposition: attachment; filename=subscriptions.csv");

    //echo(getcwd());
    require_once('../../../../wp-load.php');
	$table_users = $wpdb->prefix . "wpfes_users";
    $opts=get_option('wpfes_form_fields');
    $limit=0;
    $i=0;
    for($i=2;$i<=15;$i++){
        if(strlen($opts[$i])>0){
            $limit=$i;
        }
    }
    echo('email');
    for($i=2;$i<=$limit;$i++){
        if(strpos($opts[$i],'|')){
            $dat=explode('|',$opts[$i]);
            echo(','.$dat[0]);
        } else {
            echo(','.$opts[$i]);
        }
    }
    echo("\n");
    $users = $wpdb->get_results("SELECT * FROM $table_users WHERE `msg_sent` = '1' ORDER BY `id` DESC");
   // var_dump("SELECT * FROM $table_users WHERE `msg_sent` = '1' ORDER BY `id` DESC");
         foreach ($users as $user) {
    //var_dump($user);
            echo $user->email;
            $data=$user->custom_data;
            $data=explode("\n",$data);
            //var_dump($data);
            $atts=array();
            foreach($data as $line){
                $line=explode(": ",$line);
                $key=trim($line[0],"#");
                $key=(int)($key);
                $val=$line[1];
                $atts[$key]=$val;
            }
            for($i=2;$i<=$limit;$i++){
                echo(','.$atts[$i]);
            }
            echo("\n");
         }

} else {
    echo('<h2>Function only available through the admin interface</h2>');
}
?>