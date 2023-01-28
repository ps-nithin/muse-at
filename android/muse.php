<?php
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
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
<div class="menu_item first_menu_item"><a href="index.php">home</a>
</div><div class="menu_item act_menu"><a href="muse.php">send closed</a>
</div><?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $username=$_SESSION['username'];
  echo "<div class='menu_item last_menu_item float_right'><a href='logout.php'>logout</a></div>"; 
}else{
  echo "<div class='menu_item'><a href='login.php'>login</a></div>";
}
?>
</div></div>
<div class="content_div">
<div class="welcome"><h2>send a closed message.</h2></div>
<form class="content first_item" action="get_user.php" method="post">

@&nbsp;<input class="input_text" type="text" name="receiver" placeholder="enter muse id" value="<?php 
if(isset($_GET['id'])){
  echo $_GET['id'];
}
?>"</input>
<input class="input_button" type="submit" value="submit">
<?php 
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<div class='welcome'><p>message sent.</div>";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<div class='welcome'><p>message not sent.</div>";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<div class='welcome'><p>invalid muse id.</div>";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<div class='welcome'><p>invalid sender details.</div>";
}
?>
</form>
</div>
</body>
</html>
