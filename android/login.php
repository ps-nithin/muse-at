<?php
/*
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
*/
if(isset($_GET['token'])){
  setcookie('token_not',$_GET['token'],time()+60*60*24*30*12*10);
}

if(!isset($_COOKIE['loggedin'])){
  setcookie("loggedin","0",time()+60*60*24*30*12*10);
}

if(isset($_GET['exit'])){
  setcookie("current_page","welcome");
  header('Location: welcome.php');
  exit();
}
if(isset($_COOKIE['token_'])){
  if($_COOKIE['current_page']=="inbox"){
    header('Location: view_inbox.php?id='.$_COOKIE['current_inbox']);
    exit();
  }
  header('Location: welcome.php');
  exit();
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
<div class="menu_item first_menu_item"><a href="index.php">Home</a>
</div><div class="menu_item act_menu"><a href="login.php">Login</a>
</div><div class="menu_item"><a href="signup.php">Signup</a></div>
</div>
</div>
<div class="content_div">
<div class="welcome"><h1>See your messages.</h1>
</div>
<form class="content" action="login_test.php" method="post">
    <input class="input_text" type="text" name="user_name" placeholder="Enter Muse ID"/><br>
    <input class="input_text" type="password" name="pass_word" placeholder="Enter password"/><br>
    <input class="input_text" type="hidden" name="token_post" value="<?php echo $_GET['token'];?>"/><br>
    <input class="input_button" type="submit" value="Login"/>&nbsp;&nbsp;<a href="reset_login.php">Forgot password</a><?php
    if(isset($_GET['r']) && $_GET['r']==0){
      echo "<div class='welcome'><p>invalid muse id or password.</div>";
     }else if(isset($_GET['r']) and $_GET['r']==1){
	echo "<div class='welcome'><p>error 1.</div>";
     }

    ?>
    </form>
</div>
</body>
</html>
