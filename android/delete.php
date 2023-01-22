<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item"><a class="menu_link" href="login.php">back</a></div>
<div class="menu_item act_menu"><a class="menu_link" href="delete.php">delete</a></div>
</div></div>
<div class="content_div">
<form action="delete_test.php" method="post">
<h1>this will delete your muse id.</h1><p>you cannot use the same muse id again.</p>
<input class="input_text" type="text" name="user_name" placeholder="enter muse id"/><br>
<input class="input_text" type="password" name="pass_word" placeholder="enter password"/><br>
<input class="input_button" type="submit" value="delete"><?php
if(isset($_GET['r']) && $_GET['r']==0){
  echo "<p>invalid muse id or password.";
}else if(isset($_GET['r']) && $_GET['r']==1){
  echo "<p>muse id deleted successfully.";
}
?>
</form></div>
</body>
</html>
