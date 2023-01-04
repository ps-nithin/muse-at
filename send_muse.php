<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header('location:login.php');
  exit;
}

require('mysql_conn.php');
$username=trim($_SESSION['username']);
$receiver=trim($_POST['receiver']);
$receiver=filter_var($receiver,FILTER_SANITIZE_STRING);
$messages=trim($_POST['send_content']);
$messages=filter_var($messages,FILTER_SANITIZE_STRING);
$max_msg=1000;
if(strlen($messages)==0){
	header('location:view_inbox.php?id='.$receiver);
	exit;
}
$result=$conn->query("select id from $username where sender='$receiver' or receiver='$receiver' order by id asc;");
if($result->num_rows==$max_msg){
  $row=$result->fetch_assoc();
  $conn->query("delete from $username where id='".$row['id']."';");
}
$result=$conn->query("select id from $receiver where sender='$username' or receiver='$username' order by id asc;");
if($result->num_rows==$max_msg){
  $row=$result->fetch_assoc();
  $conn->query("delete from $receiver where id='".$row['id']."';");
}

$time=date("h:ia").", ".date("d M Y");
$conn->query("insert into $receiver (inbox,sender,timeinbox,viewed) values ('$messages','$username','$time',0);");
$conn->query("insert into $username (outbox,receiver,timeoutbox,viewed) values ('$messages','$receiver','$time',1);");
header('location:view_inbox.php?id='.$receiver);

?>
