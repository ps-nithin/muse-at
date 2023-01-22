<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $username=$_SESSION['username'];
}
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">home</a>
</div><div class="menu_item"><a href="muse_a.php">send</a></div><?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo "<div class='menu_item'><a href='logout.php'>logout @$username</a></div>";
}else{
  echo "<div class='menu_item'><a href='login.php'>login</a></div>";
  echo "<div class='menu_item'><a href='signup.php'>signup</a></div>";
}
?>
<div class="menu_item"><a href="faq.php">faq</a></div>
<div class="menu_item act_menu"><a href="help.php">help</a></div>
</div></div>
<div class="content_div"><div class="content">
<p>send your queries to <a href="muse_a.php?id=help">@help</a></p></div>
</div>
</body>
</html>
