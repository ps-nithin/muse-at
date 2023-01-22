<?php
require('mysql_conn.php');
$username=strtolower(trim($_POST['user_name']));
$username=filter_var($username,FILTER_SANITIZE_STRING);
$password=trim($_POST['pass_word']);
$password=filter_var($password,FILTER_SANITIZE_STRING);
$session_timeout=2592000;
$result=$conn->query("select username,password,delete_flag from users where username='$username';");
if($result->num_rows==0 or strlen($username)==0 or strlen($password)==0){
  header('location:login.php?r=0');
  echo "user not found.";
}else if($result->num_rows==1){
  $row=$result->fetch_assoc();
  $db_password=trim($row['password']);
  if(password_verify($password,$db_password) and $row['delete_flag']==0){
    ini_set("session.gc_maxlifetime",$session_timeout);
    session_set_cookie_params($session_timeout);
    session_start();
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;
    header("location: welcome.php");
  }else{
    header('location:login.php?r=0');
    echo "wrong password";
  }
}
?>
