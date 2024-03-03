<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
    header('location:open.php');
    exit;
}
require("mysql_conn.php");
$username=$_SESSION['username'];
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
    <title>Muse@ - Open message</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">Home</a>
</div><div class="menu_item"><a href="muse.php">Send Closed</a>
</div><div class="menu_item act_menu"><a href="open.php">Send Open</a>
</div><div class="menu_item"><a href="settings.php">+</a>
</div><div class='menu_item last_menu_item float_right'>
    <a href='logout.php'>Logout @<?php echo $username;?></a></div>
</div></div>
<div class="content_div">
<div class="welcome"><h2>Send an Open message.</h2></div>
<form class="content first_item" action="get_user_a.php" method="post">
@&nbsp;<input class="input_text" type="text" name="receiver" placeholder="Enter Muse ID" value="<?php 
if(isset($_GET['id'])){
  echo $_GET['id'];
}
?>"</input>
<input class="input_button" type="submit" value="Submit">
<div class="welcome">
<?php 
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<p>Message sent.";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<p>Message not sent.";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<p>Invalid muse id.";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<p>Invalid sender details.";
}
?>
</div>
</form>
</div>
</body>
</html>
