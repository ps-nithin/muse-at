<?php
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
require("mysql_conn.php");
$username=$_SESSION['username'];
?>
<html>
    <head>
        <title>muse@ - welcome</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class='menu_item act_menu first_menu_item'><a href='welcome.php'>home</a>
</div><div class="menu_item"><a href="muse.php">send closed</a></div>
<div class="menu_item"><a href="settings.php">+</a></div>
<div class='menu_item last_menu_item float_right'><a href='logout.php'>logout</a>
</div></div></div>

<div class="content_div"><div class="welcome"><h2>welcome @<?php echo $username;?> ,</h2></div>
<?php
$result=$conn->query("select distinct sender from $username where inbox is not null union select distinct receiver from $username where outbox is not null;");
if($result->num_rows==0){
  echo "<div class='welcome'><p>no messages.</p></div>";
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

?>
</div>
</body>
</html>
