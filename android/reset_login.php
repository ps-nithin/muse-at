<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true){
  header("location: welcome.php");
  exit;
}
setcookie("current_page","reset");
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="login.php">&lt;</a>
</div><div class="menu_item act_menu"><a href="reset_login.php">Reset</a>
</div>
</div></div>
<div class="content_div">
<div class="welcome"><h1>Reset your login</h1></div>
<form class="content" action="reset_otp.php" method="post">
    <input class="input_text" type="text" name="user_name" placeholder="Enter Muse ID"/>
    <input id="reset_submit" class="input_button" type="submit" value="Submit"/>
    <?php
    if(isset($_GET['r']) && $_GET['r']==0){
      echo "<div class='welcome'><p>Invalid Muse ID.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==1){
      echo "<div class='welcome'><p>Wrong OTP.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==2){
      echo "<div class='welcome'><p>Invalid password.<p>password length should be 8-15 characters long.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==3){
      echo "<div class='welcome'><p>Pe-entered password is wrong.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==4){
      echo "<div class='welcome'><p>Password changed succesfully.</div>";
    }else if(isset($_GET['r']) && $_GET['r']==1){
      echo "<div class='welcome'><p>Unknown error.</div>";
    }?>
    </form>
</div>
</body>
</html>
