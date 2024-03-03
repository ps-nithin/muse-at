<?php
/*
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  if(isset($_GET['id'])){
    header('location:muse.php?id='.trim($_GET['id']));
    exit;
  }else{
    header('location:muse.php');
    exit;
  }
}
*/
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
</div><div class="menu_item act_menu"><a href="open.php">Send Open</a>
</div><div class="menu_item"><a href="login.php">Login</a>
</div><div class="menu_item"><a href="signup.php">Signup</a>
</div><div class="menu_item"><a href="faq.php">FAQs</a></div>
</div></div>
<div class="content_div">
<div class="welcome"><h1>Send an Open message.</h1></div>
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
  echo "<p>Invalid Muse ID.";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<p>Invalid sender details.";
}
?>
</div>
</form>
</div>
<div class="footer_div">
    <p>This is an Open-source project. Find code on<a href="https://github.com/ps-nithin/muse-at/" target="_blank">&nbsp;github</a></p>
</div>
</body>
</html>
