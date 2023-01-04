<?php
require('mysql_conn.php');
$receiver=strtolower(trim($_POST['receiver']));
$receiver=filter_var($receiver,FILTER_SANITIZE_STRING);
$messages=trim($_POST['muse_content']);
$messages=filter_var($messages,FILTER_SANITIZE_STRING);
$max_msg=100;
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
  if($conn->query("insert into $receiver (inbox,sender,timeinbox,viewed) values ('$messages','$username','$time',0);")===true){
    header('location:open.php?r=1&id='.$receiver);
    exit;
  }else{
    header('location:open.php?r=0&id='.$receiver);
    exit;
  }
?>
