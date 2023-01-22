<?php
session_start();
require("mysql_conn.php");
$username=trim($_POST['user_name']);
$password=trim($_POST['pass_word']);
$repassword=trim($_POST['re_pass_word']);
$otp=trim($_POST['otp']);
$password_filtered=preg_replace("/[^A-Za-z0-9]/",'',$password);
$otp_session=$_SESSION['otp_reset'];
if(strcmp(trim($otp),$otp_session)!==0){
  header("location:reset_login.php?r=1&otp_session=$otp_session");
  exit;
}
if(strlen($password_filtered)<strlen($password) or strlen($password)<8 or strlen($password)>15){
  header('location:reset_login.php?r=2');
  exit;
}
if(strcmp($password,$repassword)!==0){
  header('location:reset_login.php?r=3');
  exit;
}

$password_hashed=password_hash($password,PASSWORD_DEFAULT);

$result=$conn->query("update users set password='$password_hashed' where username='$username';");
if($result){
  header('location:reset_login.php?r=4');
  exit;
}else{
  header('location:reset_login.php?r=5');
  exit;
}
?>
