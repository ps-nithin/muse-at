<?php
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
<div class="menu_item first_menu_item"><a href="open.php">send open</a>
</div><div class="menu_item act_menu"><a href="faq_open.php">faq</a></div>
</div></div>
<div class="content_div"><div class="content first_item">
<h2>what is this all about?</h2>
<p>a new and open way of communication.
<h2>what is a muse id?</h2>
<p>a muse id is a unique id that identifies a user to the world.
<h2>what to do with a muse id?</h2>
<p>share your muse id with the world and you can receive open and closed messages from the world.
<h2>what are open and closed messages?</h2>
<p>an open message is a message in which you cannot know the identity of the sender while a closed message is a message in which you can know the identity of the sender.</p>
<h2>who can send you a message?</h2>
<p>anyone who knows your muse id can send you a message.
<hr>
<p>send your queries to <a href="open.php?id=help">@help</a></p></div>
</div>
</body>
</html>
