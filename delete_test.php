<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
require('mysql_conn.php');
$username=strtolower(trim($_POST['user_name']));
$username=filter_var($username,FILTER_SANITIZE_STRING);
$password=trim($_POST['pass_word']);
$password=filter_var($password,FILTER_SANITIZE_STRING);

$result=$conn->query("select username,password,delete_flag from users where username='$username';");
if($result->num_rows==0 or strlen($username)==0 or strlen($password)==0){
  header('location:delete.php?r=0');
  echo "user not found.";
}else if($result->num_rows==1){
  $row=$result->fetch_assoc();
  if($row['delete_flag']==1){
    header('location:delete.php?r=0');
    exit;
  }
  $db_password=trim($row['password']);
  if(strcmp($password,$db_password)==0){
    $conn->query("update users set delete_flag='1' where username='$username';");
    $conn->query("drop table $username;");
    session_start();
    $_SESSION=array();
    session_destroy();
    header("location: delete.php?r=1");
  }else{
    header('location:delete.php?r=0');
    echo "wrong password";
  }
}
?>
