<?php
require('mysql_conn.php');
$feed_name=$_POST['audio_feed'];
$feed_value=$_POST['feed_value'];
$museid=$_POST['museid'];
$passcode=$_POST['passcode'];
$result=$conn->query("select passcode from ".$museid."_edge_feed where feed_name='$feed_name';");
$row=$result->fetch_assoc();
$db_passcode=trim($row['passcode']);

if(password_verify($passcode,$db_passcode)){
    $result=$conn->query("update $museid."_edge_feed" set feed_value='$feed_value' where feed_name='$feed_name';");
}

?>