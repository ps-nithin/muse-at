<?php
/*
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
*/
require('protected.php');
?>

<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
    <title>muse@ - sending closed message</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="welcome.php">Home</a>
</div><div class="menu_item act_menu"><a href="muse.php">Send Closed</a>
</div><div class="menu_item"><a href="settings.php">+</a></div>
<div class="menu_item last_menu_item float_right"><a href="logout.php">Logout</a></div>
</div></div>
<div class="content_div">
<div class="welcome"><h2>Send a Closed Message.</h2></div>
<form class="content first_item" action="get_user.php" method="post">
<span>@</span><input class="input_text" type="text" name="receiver" placeholder="Enter Muse ID" value="<?php 
if(isset($_GET['id'])){
  echo $_GET['id'];
}
?>"</input>
<input class="input_button" type="submit" value="Submit">
<input class="input_button" type="button" value="Scan" onClick="showAndroidScan()"/>

<?php 
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<div class='welcome'><p>Message sent.</div>";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<div class='welcome'><p>Message not sent.</div>";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<div class='welcome'><p>Invalid Muse ID.</div>";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<div class='welcome'><p>Invalid sender details.</div>";
}
?>
</form>
</div>
<script type="text/javascript">
    function showAndroidScan(){
        Android.showScan();
    }
</script>
</body>
</html>
