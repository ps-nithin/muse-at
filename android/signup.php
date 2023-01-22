<html>
<head>
    <title>muse@ - signup</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">home</a>
</div><div class="menu_item"><a href="login.php">login</a>
</div><div class="menu_item act_menu"><a href="signup.php">signup</a>
</div></div></div>
<div class="content_div">
<div class="welcome"><h1>create a muse id.</h1></div>
<form class="content" action="signup_otp.php" method="post">
<input class="input_text" type="text" name="email" placeholder="enter email"/><br>
<input class="input_text" type="text" name="full_name" placeholder="enter full name"/><br>
<input class="input_text" type="text" name="user_name" placeholder="enter muse id"/><br>
<input class="input_text" type="password" name="pass_word" placeholder="enter password"/><br>
<input class="input_text" type="password" name="re_pass_word" placeholder="re-enter password"/><br>
<input class="input_button" type="submit" value="create">
<?php
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<div class='welcome'><p>muse id '".$_GET['id']."' registered succesfully.</div>";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<div class='welcome'><p>muse id not available.</div>";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<div class='welcome'><p>invalid muse id. only letters,numbers and underscores are allowed.";
  echo "<p>password length should be 8-15 characters long.</div>";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<div class='welcome'><p>invalid password. only letters and numbers are allowed.</div>";
}else if(isset($_GET['r']) && $_GET['r']==4){
  echo "<div class='welcome'><p>unknown error.</div>";
}else if(isset($_GET['r']) && $_GET['r']==5){
  echo "<div class='welcome'><p>password mismatch.</div>";
}else if(isset($_GET['r']) && $_GET['r']==6){
  echo "<div class='welcome'><p>unknown error.</div>";
}else if(isset($_GET['r']) && $_GET['r']==7){
  echo "<div class='welcome'><p>invalid email.</div>";
}else if(isset($_GET['r']) && $_GET['r']==8){
  echo "<div class='welcome'><p>invalid otp.</div>";
}
?>
</form>
</div>
</body>
</html>
