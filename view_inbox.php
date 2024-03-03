<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
require("mysql_conn.php");
$username=trim($_SESSION['username']);
$museid=trim($_GET['id']);
?>
<html>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
    <title>muse@ - inbox</title>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
<?php
  echo "<body onload=\"getContentInit('$username','$museid')\">";
?>
<div class="header_wrap">
<div class="header_div">
    <div class="menu_item first_menu_item"><a href="welcome.php">&lt;&nbsp;Back</a></div>
    <div class="menu_item act_menu"><?php echo "@".$_GET['id'];?></div>
    <div class="menu_item last_menu_item float_right"><a href="logout.php"><?php echo "Logout @$username"?></a></div>
</div>
</div>
<div class="control_div">
  <?php
    echo "<div id='get_content' class='menu_item' onclick=\"getContent('$username','$museid')\">&uarr;</div>";
  ?>
</div>

  <div id="id_content_div" class='content_div_inbox'>
  </div>

<?php 
$del_query=$conn->query("select delete_flag from users where username='$museid';");
$del_flag=$del_query->fetch_assoc();

if(strcmp(trim($museid),"open")!=0 and $del_flag['delete_flag']==0){
echo "
  <div class='footer_wrap_inbox'>  
  <div class='footer_div_inbox'>
  <form method='post' class='inbox_form'>
  <input type='submit' class='input_button_inbox' id='send_id' value='Send'/> 
  <input type='text' class='input_text_inbox' id='send_content_id' autocomplete='off' name='send_content' placeholder='Type here...'/>
  <input type='hidden' id='receiver_id' name='receiver' value='".$museid."'/></form></div></div>";
}
?>
</body>
</html>
