<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
	$username=$_SESSION['username'];
	header('location:welcome.php');
	exit;
}
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/> 
<head>
    <title>muse@ - home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="div_splash">
    <div class="splash_arrow"><h2>pull down to login</h2></div>
    <div class="splash_content">
        <h1>muse@</h1>
    </div>
</div>


<div class="footer_div">
    <p>this is an opensource project. find code at github.</p>
</div>
</body>
</html>
