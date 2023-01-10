<?php
require('mysql_conn.php');
$receiver=strtolower(trim($_POST['receiver']));
$receiver=filter_var($receiver,FILTER_SANITIZE_STRING);
$messages=trim($_POST['muse_content']);
$messages=filter_var($messages,FILTER_SANITIZE_STRING);
$max_msg=100;

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$result=$conn->query("select password from users where username='$receiver';");
$row=$result->fetch_assoc();
$encryption_key = $row['password'];
$messages_encrypted = openssl_encrypt($messages, $ciphering, $encryption_key, $options, $encryption_iv);


if(strlen($messages)==0){
  header('location:open.php?r=0&id='.$receiver);
  exit;
}
  $username="open";
  $time=date("h:i:sa").", ".date("d M Y");
  $result=$conn->query("select id from $receiver where sender='$username' order by id asc;");
  if($result->num_rows==$max_msg){
	$row=$result->fetch_assoc();
	$id=$row['id'];
	$conn->query("delete from $receiver where id='$id';");
  }
  if($conn->query("insert into $receiver (inbox,sender,timeinbox,viewed) values ('$messages_encrypted','$username','$time',0);")===true){
    header('location:open.php?r=1&id='.$receiver);
    exit;
  }else{
    header('location:open.php?r=0&id='.$receiver);
    exit;
  }
?>
