<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header('location:login.php');
  exit;
}
require('mysql_conn.php');
$username=strtolower(trim($_SESSION['username']));
$username=filter_var($username,FILTER_SANITIZE_STRING);
$messages=trim($_POST['muse_content']);
$messages=filter_var($messages,FILTER_SANITIZE_STRING);
$receiver=strtolower(trim($_POST['receiver']));
$max_msg=100;

if(strlen($messages)==0){
  header('location:muse.php?r=0&id='.$receiver);
  exit;
}
$time=date("h:ia").", ".date("d M Y");

$result=$conn->query("select id from $username where sender='$receiver' or receiver='$receiver' order by id asc;");
if($result->num_rows==$max_msg){
	$row=$result->fetch_assoc();
	$id=$row['id'];
	$conn->query("delete from $username where id='$id';");
}
$result=$conn->query("select id from $receiver where sender='$username' or receiver='$username' order by id asc;");
if($result->num_rows==$max_msg){
	$row=$result->fetch_assoc();
	$id=$row['id'];
	$conn->query("delete from $receiver where id='$id';");
}

$sql_inbox="insert into $receiver (inbox,sender,timeinbox,viewed) values ('$messages','$username','$time',0);";
$sql_outbox="insert into $username (outbox,receiver,timeoutbox,viewed) values ('$messages','$receiver','$time',0);";

if($conn->query($sql_inbox)===true and $conn->query($sql_outbox)==true){
  header('location:muse.php?r=1&id='.$receiver);
  exit;
}else{
  header('location:muse.php?r=0&id='.$receiver);
  exit;
}
?>
