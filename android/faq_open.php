<?php
$session_timeout=2592000;
ini_set("session.gc_maxlifetime",$session_timeout);
session_set_cookie_params($session_timeout);
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $username=$_SESSION['username'];
}
?>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class="menu_item first_menu_item"><a href="open.php">Send Open</a>
</div><div class="menu_item act_menu"><a href="faq_open.php">FAQs</a></div>
</div></div>
<div class="content_div"><div class="content first_item">
<h2>What is this all about?</h2>
<p>A new and open way of communication.
<h2>What is a Muse ID?</h2>
<p>A Muse ID is a unique id that identifies a user to the world.
<h2>What to do with a Muse ID?</h2>
<p>Share your Muse ID with the world and you can receive open and closed messages from the world.
<h2>What are open and closed messages?</h2>
<p>An open message is a message in which you cannot know the identity of the sender while a closed message is a message in which you can know the identity of the sender.</p>
<h2>Who can send you a message?</h2>
<p>Anyone who knows your Muse ID can send you a message.
<hr>
<p>Send your queries to <a href="open.php?id=help">@help</a></p></div>
</div>
</body>
</html>
