<?php
//if(strlen($_GET['download'])>0){
//    require_once dirname(__FILE__).'/download-'.strtolower($_GET['download']).'.php';
//}
$csv_url=get_bloginfo('wpurl').'/wp-content/plugins/'.basename(dirname(dirname(__FILE__))).'/'.basename(dirname(__FILE__)).'/download-csv.php?execute=true';
   


?>
<div id="admin_wpfes">
<h3 class="wpfestitle">Online opted-in users backup</h3>
<p class="info-tip">
</p>
<?php
    $url = get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=' . $_GET['page'].'&wpfes-mode=list';
if ($users = $wpdb->get_results("SELECT * FROM $table_users WHERE `msg_sent` = '1' ORDER BY `id` DESC")) {
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td width="50%"><h4 onclick="show_bcc();" style="cursor: pointer; font-style: italic;">&gt;&gt; Show BCC friendly format</h4></td>
        <td width="50%"><h4><i>&gt;&gt; Download list as: </i><a target="_blank" href="<?php echo($csv_url); ?>">CSV</a></h4></td>
    </tr>
</table>
    
    <p style="display: none;" id="bcc-p"><code>
        <?php
        $additional_user=0;
        foreach ($users as $user) {
            if ($user->msg_sent == "1") {
                if ($additional_user) {
                    echo ', ';
                }
                $additional_user=1;
                echo $user->email;
            }
        }
        ?></code>
    </p>
<?php
}
if ($users = $wpdb->get_results("SELECT * FROM $table_users ORDER BY `id` DESC")) {
    $user_no=0;
    //$url = get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=' . basename(dirname(__FILE__)). '/' . basename(__FILE__);
?>
    <table class="widefat">
        <thead>
        <tr align="right">
            <td colspan="6">
    <script type="text/javascript">
    function confirm_purge (frm) {
        if(frm.purge.selectedIndex != 0 && confirm('Are you sure you want to proceed?')) {
            top.location.href='<?php echo $url; ?>&purge=' + frm.purge.options[frm.purge.selectedIndex].value;
        }
    }
    function show_bcc(){
        document.getElementById('bcc-p').style.display="block";
    }
    </script>
                <form method="get" action="">
                    <fieldset class="options">Purge non opted-in users:
                        <select name="purge" id="purge">
                            <option value="0">Select...</option>
                            <option value="1">All</option>
                            <option value="2">Older than 1 week</option>
                            <option value="3">Older than 2 weeks</option>
                            <option value="4">Older than 1 month</option>
                        </select>
                        <input type="button" name="prg_btn" id="prg_btn" value="Go" onclick="confirm_purge(this.form)" />
                    </fieldset>
                </form>
            </td>
        </tr>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Date/Time</th>
            <th scope="col">Opted-in</th>
            <th scope="col">IP</th>
            <th scope="col">E-mail</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
<?php
    $url = $url . '&amp;user_id=';
    foreach ($users as $user) {
        if ($user_no&1) {
            echo "<tr class=\"alternate\">";
        } else {
            echo "<tr>";
        }
        $user_no=$user_no+1;
        echo "<td>$user->id</td>";
        echo "<td>" . date(get_option('date_format'), $user->time). " " . date(get_option('time_format'), $user->time) . "</td>";
        echo "<td>";
        echo $user->msg_sent ? "Yes" : "No";
        echo "</td>";
        echo "<td>$user->ip</td>";
        echo "<td>$user->email</td>";
        echo "<td><a href=\"$url$user->id\" onclick=\"if(confirm('Are you sure you want to delete user with ID $user->id?')) return; else return false;\">Delete</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
}
?>
<p class="info-tip">It is not recommended to keep a list longer than 500 subscriptions online.</p>
</div>