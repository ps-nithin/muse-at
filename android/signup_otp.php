<?php
session_start();
require('mysql_conn.php');
require('send.php');

$username=trim($_POST['user_name']);
$password=trim($_POST['pass_word']);
$email=trim($_POST['email']);
$repassword=trim($_POST['re_pass_word']);
$username=strtolower($username);
$username_filtered=preg_replace("/[^A-Za-z0-9_]/",'',$username);
$password_filtered=preg_replace("/[^A-Za-z0-9]/",'',$password);
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  header('location:signup.php?r=7');
  exit;
}
if(strlen($username_filtered)<strlen($username) or strlen($username_filtered)==0 or strlen($password_filtered)<8 or strlen($password_filtered)>15){
  header('location:signup.php?r=2');
  exit;
}

$max_users=1024;
$result=$conn->query("select * from users where username='$username';");
$no_users=$conn->query("select * from users where delete_flag='0';");

if($no_users->num_rows>=$max_users){
  header('location:signup.php?r=6');
  exit;
}
if ($result->num_rows>0 or strcmp($username,"open")==0){
  header('location:signup.php?r=0');
  exit;
}
if(strlen($password_filtered)<strlen($password) or strlen($password_filtered)==0){
  header('location:signup.php?r=3');
  exit;
}
if(strcmp($password_filtered,$repassword)!=0){
  header('location:signup.php?r=5');
  exit; 
}
$fullname=trim($_POST['full_name']);
$otp_val=rand(10000,99999);
$_SESSION['otp_signup']=$otp_val;
/*
 * send otp to email here.
 * */
sendOTP($otp_val,$email);

$password_hashed=password_hash($password,PASSWORD_DEFAULT);

?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="../style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="index.php">Home</a>
</div><div class="menu_item"><a href="login.php">Login</a>
</div><div class="menu_item act_menu"><a href="signup.php">Signup</a>
</div></div></div>
<div class="content_div">
<form class="content" action="create_user.php" method="post">
<div class="welcome"><h1>Create a Muse ID.</h1></div>
<input class="input_text" type="text" name="otp" placeholder="enter otp"/>
<input class="input_text" type="hidden" name="email" value="<?php echo $email;?>"/>
<input class="input_text" type="hidden" name="full_name" value="<?php echo $fullname;?>"/>
<input class="input_text" type="hidden" name="user_name" value="<?php echo $username;?>"/>
<input class="input_text" type="hidden" name="pass_word" value="<?php echo $password_hashed;?>"/>
<input class="input_button" type="submit" value="Create">
<p class="welcome">OTP sent to your email.</p>
<?php
if(isset($_GET['r']) && $_GET['r']==1){
  echo "<p>Muse ID '".$_GET['id']."' registered succesfully.";
}else if(isset($_GET['r']) && $_GET['r']==0){
  echo "<p>Muse ID not available.";
}else if(isset($_GET['r']) && $_GET['r']==2){
  echo "<p>Invalid Muse ID. Only letters,numbers and underscores are allowed.";
  echo "<p>Password length should be 8-15 characters long.";
}else if(isset($_GET['r']) && $_GET['r']==3){
  echo "<p>Invalid password. only letters and numbers are allowed.";
}else if(isset($_GET['r']) && $_GET['r']==4){
  echo "<p>Unknown error.";
}else if(isset($_GET['r']) && $_GET['r']==5){
  echo "<p>Password mismatch.";
}else if(isset($_GET['r']) && $_GET['r']==6){
  echo "<p>Unknown error.";
}
?>
</form>
</div>
</body>
</html>
