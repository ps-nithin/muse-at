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
<div class="header_wrap">
<div class="header_div">
<div class="menu_item act_menu first_menu_item"><a href="">home</a>
</div><?php
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo "<div class='menu_item'><a href='logout.php'>logout</a></div>";
  }else{
    echo "<div class='menu_item'><a href='open.php'>send open</a></div>";
    echo "<div class='menu_item'><a href='login.php'>login</a></div>";
    echo "<div class='menu_item'><a href='signup.php'>signup</a></div>";
    echo "<div class='menu_item'><a href='faq.php'>faq</a></div>";
  }?>
</div></div>

<div class="content_div"><div class="welcome"><h1>muse@</h1><p>1. create a muse id.<p>2. share your muse id with the world.<p>3. receive  messages from the world.<p><a href='http://play.google.com/store/apps/details?id=com.messaging.muse&pcampaignid=pcampaignidMKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'><img id='playstore' alt='Get it on Google Play' src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png'/></a></p></div>
</div>

<div class="footer_div">
    <p>this is an opensource project. find code at <a href="https://github.com/ps-nithin/muse-at/" target="_blank">github</a></p>
</div>
</body>
</html>
