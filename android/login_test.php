<?php
require('mysql_conn.php');
use Firebase\JWT\JWT;
require_once('vendor/autoload.php');
/*
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
$token=$_SESSION['token'];
*/
if(isset($_COOKIE['token_not'])){
  $token_not=$_COOKIE['token_not'];
}else{
  $token_not="noactive";
}
$username=strtolower(trim($_POST['user_name']));
$username=filter_var($username,FILTER_SANITIZE_STRING);
$password=trim($_POST['pass_word']);
$password=filter_var($password,FILTER_SANITIZE_STRING);

$secretKey='muse-at.com';
$issuedAt=new DateTimeImmutable();
$expire=$issuedAt->modify('+10 years')->getTimestamp();
$serverName="www.muse-at.com";
$data=['iat'=>$issuedAt->getTimestamp(),
       'iss'=>$serverName,
       'nbf'=>$issuedAt->getTimestamp(),
       'exp'=>$expire,
       'data'=>['username'=>$username,]];
$result=$conn->query("select username,password,delete_flag from users where username='$username';");
if($result->num_rows==0 or strlen($username)==0 or strlen($password)==0){
  header('location:login.php?r=1');
  echo "user not found.";
}else if($result->num_rows==1){
  $row=$result->fetch_assoc();
  $db_password=trim($row['password']);
  if(password_verify($password,$db_password) and $row['delete_flag']==0){
    /*
    ini_set("session.gc_maxlifetime",$session_timeout);
    session_set_cookie_params($session_timeout);
    session_start(); // ready to go!
    $_SESSION['loggedin']=true;
    $_SESSION['username']=$username;
    */
    $conn->query("update users set token_id='$token_not' where username='$username';");
    $token_=JWT::encode($data,$secretKey,'HS512');
    setcookie("token_", $token_,time()+60*60*24*30*12*10);
    setcookie("loggedin","1",time()+60*60*24*30*12*10);
    header("location: welcome.php");
  }else{
    header('location:login.php?r=0');
    echo "wrong password";
  }
}
?>
