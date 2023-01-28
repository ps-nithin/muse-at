<?php
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true){
  header("location: welcome.php");
  exit;
}

if(isset($_GET['token'])){
    $token=$_GET['token'];
    $_SESSION['token']=$token;
}else{
    $token=$_SESSION['token'];
}
?>

<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
    <title>muse@ - login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">home</a>
</div><div class="menu_item act_menu"><a href="login.php">login</a>
</div><div class="menu_item"><a href="signup.php">signup</a></div>
</div>
</div>
<div class="content_div">
<div class="welcome"><h1>see your messages.</h1>
</div>
<form class="content" action="login_test.php" method="post">
    <input class="input_text" type="text" name="user_name" placeholder="enter muse id"/><br>
    <input class="input_text" type="password" name="pass_word" placeholder="enter password"/><br>
    <input type="hidden" name="token_post" value="<?php echo $token;?>"/>
    <input class="input_button" type="submit" value="login"/>&nbsp;&nbsp;<a href="reset_login.php">forgot password</a><?php
    if(isset($_GET['r']) && $_GET['r']==0){
      echo "<div class='welcome'><p>invalid muse id or password.</div>";
     }?>
    </form>
</div>
</body>
</html>
