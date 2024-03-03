<?php
session_start();
require('mysql_conn.php');
require('send.php');
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']===true){
  header("location: welcome.php");
  exit;
}

$otp_val=rand(10000,99999);
$_SESSION['otp_reset']=$otp_val;
/*
 * send otp to the registered email here
 * */
$username=trim($_POST['user_name']);
$username=filter_var($username,FILTER_SANITIZE_STRING);
$result=$conn->query("select * from users where username='$username';");
$row=$result->fetch_assoc();
if($result->num_rows==0){
  header('location:reset_login.php?r=0');
  exit;
}else if($result->num_rows==1){
  if($row['delete_flag']==1){
    header('location:reset_login.php?r=0');
    exit;
  }else{
    $email=$row['email'];
    sendOTP($otp_val,$email);
  }
}else{
  header('location:reset_login.php?r=0');
  exit;
}
?>

<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="reset_login.php">&lt;</a>
</div><div class="menu_item act_menu"><a href="reset_login.php">Reset</a>
</div>
</div></div>
<div class="content_div">
<div class="welcome"><h1>Reset your login</h1><p>An OTP is sent to your email.</div>
<form class="content" action="reset.php" method="post">
    <input class="input_text" type="text" name="otp" placeholder="Enter OTP"/><br>
    <input class="input_text" type="hidden" name="user_name" value="<?php echo $username;?>"/>
    <input class="input_text" type="password" name="pass_word" placeholder="Enter new password"/><br>
    <input class="input_text" type="password" name="re_pass_word" placeholder="Re-enter new password"/><br>
    <input class="input_button" type="submit" value="Submit"/>
</form>
</div>
</body>
</html>
