<?php
/*
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!==true){
  header("location: login.php");
  exit;
}
*/
require("mysql_conn.php");
$username=$_GET['uname'];
$museid=$_GET['id'];
$page=$_GET['page'];

$ciphering = "AES-128-CTR";
$decryption_iv = '1234567891011121';
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$decryption_key = "easy_encryption";
$n=1;
$n_start=$page*20+1;
$n_end=($page+1)*20;
$html="";
$mesg_array=array();
$rows=$conn->query("select inbox,timeinbox,outbox,timeoutbox from $username where sender='".$museid."' or receiver='".$museid."' order by id desc;"); 
while($row=$rows->fetch_assoc() and $n<=$n_end){
  $n++;
  if($n>$n_start){
    if(strlen($row['outbox'])==0){
      $out="";
      $in_msg_encrypted=$row['inbox'];
      $in_msg_decrypted = openssl_decrypt($in_msg_encrypted, $ciphering, $decryption_key, $options, $decryption_iv);
      $in="<div class='mesg_row'><div class='mesg_content incoming_mesg'>".$in_msg_decrypted."<br><div class='time_row'>".$row['timeinbox']."</div></div></div>";
    }else if(strlen($row['inbox'])==0){
      $in="";
      $out_msg_encrypted=$row['outbox'];
      $out_msg_decrypted = openssl_decrypt($out_msg_encrypted, $ciphering, $decryption_key, $options, $decryption_iv);
      $out="<div class='mesg_row align_right'><div class='mesg_content outgoing_mesg'>".$out_msg_decrypted."<br><div class='time_row align_right'>".$row['timeoutbox']."</div></div></div>";
    }
    array_push($mesg_array,$in.$out);
  }
  $conn->query("update $username set viewed='1' where sender='".$museid."';");
}

$mesg_array_r=array_reverse($mesg_array);
echo join("",$mesg_array_r);
?>
