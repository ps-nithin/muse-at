<html>
<head>
    <title>muse@ - signup</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">Home</a>
</div><div class="menu_item"><a href="login.php">Login</a>
</div><div class="menu_item act_menu"><a href="signup.php">Signup</a>
</div></div></div>
<div class="content_div">
<div class="welcome"><h1>Create a Muse ID.</h1></div>
<form class="content" id="create_muse_form" action="signup_otp.php" method="post">
<input class="input_text" type="text" name="email" placeholder="Enter email"/><br>
<input class="input_text" type="text" name="full_name" placeholder="Enter full name"/><br>
<input class="input_text" type="text" name="user_name" placeholder="Enter muse id"/><br>
<input class="input_text" type="password" name="pass_word" placeholder="Enter password"/><br>
<input class="input_text" type="password" name="re_pass_word" placeholder="Re-enter password"/><br>
<input class="input_button" id="create_muse_btn" type="submit" value="Create"/>
<?php
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<div class='welcome'><p>Muse ID '".$_GET['id']."' registered succesfully.</div>";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<div class='welcome'><p>Muse ID not available.</div>";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<div class='welcome'><p>Invalid Muse ID. Only letters,numbers and underscores are allowed.";
  echo "<p>Password length should be 8-15 characters long.</div>";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<div class='welcome'><p>Invalid password. Only letters and numbers are allowed.</div>";
}else if(isset($_GET['r']) && $_GET['r']==4){
  echo "<div class='welcome'><p>Unknown error.</div>";
}else if(isset($_GET['r']) && $_GET['r']==5){
  echo "<div class='welcome'><p>Password mismatch.</div>";
}else if(isset($_GET['r']) && $_GET['r']==6){
  echo "<div class='welcome'><p>Unknown error.</div>";
}else if(isset($_GET['r']) && $_GET['r']==7){
  echo "<div class='welcome'><p>Invalid email.</div>";
}else if(isset($_GET['r']) && $_GET['r']==8){
  echo "<div class='welcome'><p>Invalid otp.</div>";
}
?>
</form>
</div>
</body>
</html>
