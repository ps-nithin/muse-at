<?php
require("protected.php");

$result=$conn->query("select deactivate_flag from users where username='$username';");
$row=$result->fetch_assoc();
if ($row['deactivate_flag']==0){
    $conn->query("update users set deactivate_flag='1' where username='$username';");
}else{
    $conn->query("update users set deactivate_flag='0' where username='$username';");
}
header("location: welcome.php");
exit;
?>

