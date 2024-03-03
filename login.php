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
    <title>Muse@ - Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">Home</a>
</div><div class="menu_item"><a href="open.php">Send Open</a>
</div><div class="menu_item act_menu"><a href="login.php">Login</a>
</div><div class="menu_item"><a href="signup.php">Signup</a></div><div class="menu_item"><a href="faq.php">FAQs</a></div>
</div>
</div>
<div class="content_div">
<div class="welcome"><h1>See your messages.</h1></div>
<form class="content" action="login_test.php" method="post">
    <input class="input_text" type="text" name="user_name" placeholder="Enter Muse ID"/><br>
    <input class="input_text" type="password" name="pass_word" placeholder="Enter password"/><br>
    <input class="input_button" type="submit" value="Login"/>&nbsp;&nbsp;<a href="reset_login.php">Forgot password</a><?php
    if(isset($_GET['r']) && $_GET['r']==0){
      echo "<div class='welcome'><p>Invalid Muse ID or password.</div>";
     }?>
    </form>
</div>
<div class="footer_div">
    <p>This is an Open-source project. Find code on<a href="https://github.com/ps-nithin/muse-at/" target="_blank">&nbsp;github</a></p>
</div>
</body>
</html>
