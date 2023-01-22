<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true){
  header("location: welcome.php");
  exit;
}
?>

<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="login.php">&lt;</a>
</div><div class="menu_item act_menu"><a href="reset_login.php">reset</a>
</div>
</div></div>
<div class="content_div">
<div class="welcome"><h1>reset your login</h1></div>
<form class="content" action="reset_otp.php" method="post">
    <input class="input_text" type="text" name="user_name" placeholder="enter muse id"/><br>
    <input class="input_button" type="submit" value="submit"/>
    <?php
    if(isset($_GET['r']) && $_GET['r']==0){
      echo "<div class='welcome'><p>invalid muse id.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==1){
      echo "<div class='welcome'><p>wrong otp.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==2){
      echo "<div class='welcome'><p>invalid password.<p>password length should be 8-15 characters long.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==3){
      echo "<div class='welcome'><p>re-entered password is wrong.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==4){
      echo "<div class='welcome'><p>password changed succesfully.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==1){
      echo "<div class='welcome'><p>unknown error.</div>";
    }?>
    </form>
</div>
</body>
</html>
