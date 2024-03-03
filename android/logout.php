<?php
/*
require("mysql_conn.php");
session_start();
$username=$_SESSION['username'];
$conn->query("update users set token_id='noactive' where username='$username';");
$_SESSION=array();
session_destroy();
*/
require('mysql_conn.php');
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
require_once('vendor/autoload.php');
$secretKey='muse-at.com';
$token_decoded = JWT::decode($_COOKIE['token_'], new Key($secretKey,'HS512'));
$valid=is_object($token_decoded);
$username=$token_decoded->data->username;
unset($_COOKIE['token_']);
setcookie('token_',null,-1);
setcookie("loggedin","0",time()+60*60*24*30*12*10);
$conn->query("update users set token_id='noactive' where username='$username';");
header('Location: welcome.php');
exit();
?>
