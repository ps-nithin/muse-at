<?php
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
require("mysql_conn.php");
$username=$_SESSION['username'];
$result=$conn->query("select deactivate_flag from users where username='$username';");
$row=$result->fetch_assoc();
if ($row['deactivate_flag']==0){
    $conn->query("update users set deactivate_flag='1' where username='$username';");
}else{
    $conn->query("update users set deactivate_flag='0' where username='$username';");
}
header("location: welcome.php");
exit;
?>

