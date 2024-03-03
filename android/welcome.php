<?php
/*
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
*/
#require('mysql_conn.php');
/*
$username=strtolower(trim($_POST['user_name']));
$password=strtolower(trim($_POST['pass_word']));
#$token=$_POST['token_post'];
$result=$conn->query("select username,password,delete_flag from users where username='$username';");
if($result->num_rows==0 or strlen($username)==0 or strlen($password)==0){
  header("location:login.php?r=0");
}else if($result->num_rows==1){
  $row=$result->fetch_assoc();
  $db_password=trim($row['password']);
  #$db_token=$row['token_id'];
  if(password_verify($password,$db_password)!=1 or $row['delete_flag']!=0){
    header("location:login.php?r=0");
  }
}
*/
#$username=$_SESSION['username'];
require("protected.php");
setcookie("current_page","welcome");
?>
<html>
    <head>
        <title>muse@ - welcome</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
</head>
<body
<div class="header_wrap">
<div class="header_div">
<div class='menu_item first_menu_item act_menu'><a href='welcome.php'>Home</a></div><div class="menu_item"><a href="muse.php">Send Closed</a></div><div class="menu_item"><a href="qrcode.php">My QR Code</a></div><div class="menu_item last_menu_item float_right"><a href="logout.php">Logout</a></div><!--<form class="menu_item last_menu_item float_right"method="post"><input type="hidden" name="logout" value="<?php echo $username;?>"/><input type="submit" class="submit_menu" value="Logout"></form>--></div></div><div class="content_div_welcome"><div class="welcome"><h2>Welcome @<?php echo $username;?> ,</h2></div><?php
$result=$conn->query("select distinct sender from $username where inbox is not null union select distinct receiver from $username where outbox is not null;");
if($result->num_rows==0){
  echo "<div class='welcome'><p>No Messages.</p></div>";
}else{
  // display id's with new messages on top
  while($sender=$result->fetch_assoc()){
      $rows=$conn->query("select inbox from $username where sender='".$sender['sender']."' and viewed='0' and inbox is not null order by id desc;"); 
      $new_inbox=$rows->num_rows;
      if($new_inbox>0){
        echo "<a href='view_inbox.php?id=".$sender['sender']."'><div class='museid_row'>@".$sender['sender']." (".$new_inbox." new message/s)</div></a>";
      }else{
      //echo "<a href='view_inbox.php?id=".$sender['sender']."'><div class='museid_row'>@".$sender['sender']."</div></a>";
      }  
  }
  // display remaining id's
  $result->data_seek(0);
  while($sender=$result->fetch_assoc()){
      $rows=$conn->query("select inbox from $username where sender='".$sender['sender']."' and viewed='0' and inbox is not null order by id desc;"); 
      $new_inbox=$rows->num_rows;
      if($new_inbox>0){
        //echo "<a href='view_inbox.php?id=".$sender['sender']."'><div class='museid_row'>@".$sender['sender']." (".$new_inbox." new message/s)</div></a>";
      }else{
        echo "<a href='view_inbox.php?id=".$sender['sender']."'><div class='museid_row'>@".$sender['sender']."</div></a>";
      }
  }
  
  
}
$result=$conn->query("select feed_name,feed_value from ".$username."_edge_feed;");
while($row=$result->fetch_assoc()){
    echo "<div class='museid_row'>#".$row['feed_name']." | ".$row['feed_value']."</div></a>";
}

?>
</div>
</body>
</html>
