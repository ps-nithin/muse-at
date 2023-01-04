<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
require("mysql_conn.php");
$username=$_SESSION['username'];
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<body>
<div class="header_wrap">
<div class="header_div">
<div class='menu_item act_menu first_menu_item'><a href='welcome.php'>< back</a>
</div>
<?php
$result=$conn->query("select deactivate_flag from users where username='$username';");
$row=$result->fetch_assoc();
if ($row['deactivate_flag']==0){
echo '<div class="menu_item"><a href="toggle_deactivate.php">deactivate open messages</a></div>';
}else{
    echo '<div class="menu_item"><a href="toggle_deactivate.php">activate open messages</a></div>';
}
?>
</div>
</body>
</html>
