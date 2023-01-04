<?php
require('mysql_conn.php');
$username=trim($_POST['user_name']);
$password=trim($_POST['pass_word']);
$email=trim($_POST['email']);
$repassword=trim($_POST['re_pass_word']);
$username=strtolower($username);
$username_filtered=preg_replace("/[^A-Za-z0-9_]/",'',$username);
$password_filtered=preg_replace("/[^A-Za-z0-9]/",'',$password);
if(strlen($username_filtered)<strlen($username) or strlen($username_filtered)==0 or strlen($password_filtered)<8 or strlen($password_filtered)>15){
  header('location:signup.php?r=2');
  exit;
}

$max_users=1024;
$result=$conn->query("select * from users where username='$username';");
$found_user=false;
$no_users=$conn->query("select * from users where delete_flag='0';");

if($no_users->num_rows>=$max_users){
  header('location:signup.php?r=6');
  exit;
}
if ($result->num_rows>0){
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
  $sql1="insert into users (username,password,delete_flag) values ('$username','$password','0');";
  $user=False;
  $table=False;
  if($conn->query($sql1)===true){
    echo "user created successfully.<br>";
    $user=True;
  }
  $sql2="create table $username (id int(6) unsigned auto_increment primary key, inbox varchar(1024),sender varchar(30),timeinbox varchar(30),outbox varchar(1024),receiver varchar(30),timeoutbox varchar(30),viewed int(6));";
 
  if($conn->query($sql2)===true){
    echo "user table created succesfully.<br>";
    $table=True;
  }

  if($user && $table){
    header('location:signup.php?r=1&id='.$username);
  }else{
    header('location:signup.php?r=4');
  }
?>
