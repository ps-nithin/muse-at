<?php
session_start();
require('mysql_conn.php');
$username=trim($_POST['user_name']);
$password=trim($_POST['pass_word']);
$email=trim($_POST['email']);
$username=strtolower($username);
$fullname=trim($_POST['full_name']);

if(strcmp(trim($_POST['otp']),$_SESSION['otp_signup'])!==0){
  header('location:signup.php?r=8');
  exit;
}else{
  echo "otp success.";
}

$sql2="create table $username (id int(6) unsigned auto_increment primary key, inbox varchar(1024),sender varchar(30),timeinbox varchar(30),outbox varchar(1024),receiver varchar(30),timeoutbox varchar(30),viewed int(6));";
if($conn->query($sql2)===true){
  echo "user table created succesfully.<br>";
}else{
  header('location:signup.php?r=4');
  exit;
}

$sql1="insert into users (username,password,email,fullname,delete_flag,token_id) values ('$username','$password','$email','$fullname','0','noactive');";
if($conn->query($sql1)===true){
  echo "user created successfully.<br>";
}else{
	header('location:signup.php?r=4');
	exit;
}


header('location:signup.php?r=1&id='.$username);

?>
