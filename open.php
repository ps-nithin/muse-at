<?php
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
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
    <title>muse@ - open message</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">home</a>
</div><div class="menu_item act_menu"><a href="open.php">send open</a>
</div><div class="menu_item"><a href="login.php">login</a>
</div><div class="menu_item"><a href="signup.php">signup</a>
</div></div></div>
<div class="content_div">
<div class="welcome"><h1>send an open message.</h1></div>
<form class="content" action="get_user_a.php" method="post">
@&nbsp;<input class="input_text" type="text" name="receiver" placeholder="enter muse id" value="<?php 
if(isset($_GET['id'])){
  echo $_GET['id'];
}
?>"</input>
<input class="input_button" type="submit" value="submit">
<div class="welcome">
<?php 
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<p>message sent.";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<p>message not sent.";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<p>invalid muse id.";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<p>invalid sender details.";
}
?>
</div>
</form>
</div>
</body>
</html>
