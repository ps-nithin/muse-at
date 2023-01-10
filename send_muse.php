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
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$result=$conn->query("select password from users where username='$username';");
$row=$result->fetch_assoc();
$encryption_key = $row['password'];
$messages_encrypted = openssl_encrypt($messages, $ciphering, $encryption_key, $options, $encryption_iv);

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
$conn->query("insert into $receiver (inbox,sender,timeinbox,viewed) values ('$messages_encrypted','$username','$time',0);");
$conn->query("insert into $username (outbox,receiver,timeoutbox,viewed) values ('$messages_encrypted','$receiver','$time',1);");
header('location:view_inbox.php?id='.$receiver);

?>
