<?php
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
	$username=$_SESSION['username'];
	header('location:welcome.php');
	exit;
}
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/> 
<head>
    <title>muse@ - home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item act_menu first_menu_item"><a href="">Home</a>
</div><?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo "<div class='menu_item'><a href='logout.php'>Logout</a></div>";
  }else{
    echo "<div class='menu_item'><a href='login.php'>Login</a></div>";
    echo "<div class='menu_item'><a href='signup.php'>Signup</a></div>";
  }?>
</div></div>

<div class="content_div"><div class="welcome"><h1>Muse@</h1><p>1. Create a Muse ID.<p>2. Share your muse id with the world.<p>3. Receive  messages from the world.</div>
</div>

<!--
<div class="footer_div">
    <p>this is an opensource project. find code at github.</p>
</div>
-->
</body>
</html>
