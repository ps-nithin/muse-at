<?php
/*
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header('location:login.php');
  exit;
}
require('mysql_conn.php');
$username=strtolower(trim($_SESSION['username']));
*/
require('protected.php');
$receiver=strtolower(trim($_POST['receiver']));
$username=filter_var($username,FILTER_SANITIZE_STRING);
$receiver=filter_var($receiver,FILTER_SANITIZE_STRING);
if(strcmp($username,$receiver)==0){
  header('location:muse.php?r=2');
  exit;
}
$result=$conn->query("select * from users where username='$receiver';");
$row=$result->fetch_assoc();
if ($result->num_rows==0 or strlen($receiver)==0 or $row['delete_flag']==1){
  header('location:muse.php?r=2');
  exit;
}
?>
<html>
<head>
    <title>muse@ - sending closed message</title>
    <script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<meta name='viewport' content='width=device-width,initial-scale=1'/>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href='muse.php'>&lt; Back</a></div>
<div class="menu_item float_right last_menu_item"><a href='logout.php'>Logout</a></div>
</div></div>
<div class="content_div">
<div class="welcome"><h2>Sending a Closed Message</h2>
<h2>to @<?php echo $receiver?></h2></div>
<form class="content">
<textarea class="input_text" id='muse_content_id' name='muse_content' maxlength='1024' placeholder='Enter your message...'></textarea>
<input type='hidden' name='receiver' id='muse_receiver_id' value='<?php echo $receiver;?>'></input><br>
<input class="input_button" id='submit_id' type='button' value='Submit' name='submit'>
</form>
</div>
</body>
</html>
