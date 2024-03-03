<?php
require('mysql_conn.php');
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
require_once('vendor/autoload.php');
$secretKey='muse-at.com';
if (!isset($_COOKIE['token_'])){
  header("Location: login.php");
  exit();
}
$token_decoded = JWT::decode($_COOKIE['token_'], new Key($secretKey,'HS512'));
$valid=is_object($token_decoded);
$username=$token_decoded->data->username;
$result=$conn->query("select username,password,delete_flag from users where username='$username';");
if($result->num_rows==0){
  setcookie('token_',null,-1);
  $conn->query("update users set token_id='noactive' where username='$username';");
  header("Location: login.php");
  exit();
}
