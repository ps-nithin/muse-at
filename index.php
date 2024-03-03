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
    <title>Muse@ - Home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item act_menu first_menu_item"><a href="">Home</a>
</div><?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo "<div class='menu_item'><a href='logout.php'>Logout</a></div>";
  }else{
    echo "<div class='menu_item'><a href='open.php'>Send Open</a></div>";
    echo "<div class='menu_item'><a href='login.php'>Login</a></div>";
    echo "<div class='menu_item'><a href='signup.php'>Signup</a></div>";
    echo "<div class='menu_item'><a href='faq.php'>FAQs</a></div>";
  }?>
</div></div>

<div class="content_div"><div class="welcome"><h1>Muse@</h1><p>1. Create a Muse ID.<p>2. Share your Muse ID with the world.<p>3. Receive  messages from the world.</div>
<a href='http://play.google.com/store/apps/details?id=com.messaging.muse&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img id='playstore' alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png'/></a>
</div>

<div class="footer_div">
    <p>This is an Open-source project. Find code on<a href="https://github.com/ps-nithin/muse-at/" target="_blank">&nbsp;github</a></p>
</div>
</body>
</html>
