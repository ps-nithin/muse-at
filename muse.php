<?php
session_start();
?>

<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
    <title>Muse@ - Sending Closed message</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">Home</a>
</div><div class="menu_item act_menu"><a href="muse.php">Send Closed</a>
</div><div class="menu_item"><a href="open_logged_in.php">Send Open</a>
</div><div class="menu_item"><a href="settings.php">+</a>
</div>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $username=$_SESSION['username'];
  echo "<div class='menu_item float_right last_menu_item'><a href='logout.php'>Logout @$username</a></div>"; 
}else{
  echo "<div class='menu_item'><a href='login.php'>Login</a></div>";
}
?>
</div></div>
<div class="content_div">
<div class="welcome"><h2>Send a Closed message.</h2></div>
<form class="content first_item" action="get_user.php" method="post">

@&nbsp;<input class="input_text" type="text" name="receiver" placeholder="Enter Muse ID" value="<?php 
if(isset($_GET['id'])){
  echo $_GET['id'];
}
?>"</input>
<input class="input_button" type="submit" value="Submit">
<?php 
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<div class='welcome'><p>Message sent.</div>";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<div class='welcome'><p>Message not sent.</div>";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<div class='welcome'><p>Invalid muse id.</div>";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<div class='welcome'><p>Invalid sender details.</div>";
}
?>
</form>
</div>
</body>
</html>
