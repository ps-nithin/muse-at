<?php
require("mysql_conn.php");
session_start();
$username=$_SESSION['username'];
$conn->query("update users set token_id='noactive' where username='$username';");
$_SESSION=array();
session_destroy();

header("location: login.php");
exit;
?>
