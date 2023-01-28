<?php
session_start();
/*
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  header('location:get_user.php');
  exit;
}
*/
require('mysql_conn.php');
$receiver=strtolower(trim($_POST['receiver']));
$receiver=filter_var($receiver,FILTER_SANITIZE_STRING);
$result=$conn->query("select * from users where username='$receiver';");
$row=$result->fetch_assoc();
if ($result->num_rows==0 or strlen($receiver)==0 or $row['delete_flag']==1 or $row['deactivate_flag']==1){
  header('location:open.php?r=2');
  exit;
}
?>
<html>
<head>
    <title>muse@ - sending open message</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<meta name='viewport' content='width=device-width,initial-scale=1'/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href='open_logged_in.php'>&lt; back</a></div>
</div></div>
<div class="content_div"><div class="welcome"><h2>sending an open message<br>to @<?php echo $receiver?></h2></div>
<form>
<textarea class="input_text" name='muse_content' id='muse_content_open_id' maxlength='1024' placeholder='enter your message...'></textarea>
<input type='hidden' id='open_receiver_id' name='receiver' value='<?php echo $receiver;?>'></input><br>
<input class="input_button" id='open_submit_id' value='submit' type='button' name='submit'>
</form>
</div>


</body>
</html>
