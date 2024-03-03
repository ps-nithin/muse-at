<?php
require("protected.php");
?>
<html>
<head>
    <title>muse@ - settings</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
</head>
<body>
<div class="header_wrap">
<div class="header_div">
<div class='menu_item first_menu_item'><a href='welcome.php'>&lt;&nbsp;</a>
</div><div class="menu_item act_menu"><a href="qrcode.php">My QR Code</a></div></div></div>
<div class="content_div">
<?php
$qr_url="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https%3A%2F%2Fwww.muse-at.com%2F@$username&choe=UTF-8";
?>
<div class="qrcode"><img id="qrcode_id" src='<?php echo $qr_url;?>'/><br>
<h1>Share your QR Code to receive messages.</h1>
<input type="button" class="welcome menu_item qrcode" value="Share" onClick="showAndroidToast('<?php echo $qr_url;?>')" />
</div></div>

<script type="text/javascript">
    function showAndroidToast(toast) {
        Android.showToast(toast);
    }
    function showAndroidScan(){
        Android.showScan();
    }
</script>
</body>
</html>
