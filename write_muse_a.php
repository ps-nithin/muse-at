<?php
require('mysql_conn.php');
$receiver=strtolower(trim($_POST['receiver']));
$receiver=filter_var($receiver,FILTER_SANITIZE_STRING);
$messages=trim($_POST['muse_content']);
$messages=filter_var($messages,FILTER_SANITIZE_STRING);
$max_msg=100;

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "easy_encryption";
$messages_encrypted = openssl_encrypt($messages, $ciphering, $encryption_key, $options, $encryption_iv);


if(strlen($messages)==0){
  header('location:open.php?r=0&id='.$receiver);
  exit;
}
  $username="open";
  $time=date("h:i:sa").", ".date("d M Y");
  $time=$_POST['time'];
  $result=$conn->query("select id from $receiver where sender='$username' order by id asc;");
  if($result->num_rows==$max_msg){
	$row=$result->fetch_assoc();
	$id=$row['id'];
	$conn->query("delete from $receiver where id='$id';");
  }
  if($conn->query("insert into $receiver (inbox,sender,timeinbox,viewed) values ('$messages_encrypted','$username','$time',0);")===true){
    require 'vendor/autoload.php';
    $client = new \Fcm\FcmClient('AAAAAgwfQzw:APA91bFXh8r8k9veJhve3cBNpPE9tL2ZOen2Uk9AqPuA_re85VMJsJbc6_knKouFzZ61K3arrLoOHGzMHo7liMp1VdxBMAHX9z2QVzlq7jG-plM4gwK6zmVJ1I3B0uEjVxNYmJetWFdg','8793310012');

    $notification = new \Fcm\Push\Notification();
    $res=$conn->query("select token_id from users where username='$receiver';");
    $row=$res->fetch_assoc();
    $deviceId=$row['token_id'];
    #$deviceId=$_SESSION['token'];
    #echo $deviceId;
    $notification
    ->addRecipient($deviceId)
    ->setTitle("New open message")
    ->setColor('#20F037')
    ->setIcon("ic_small_icon.png")
    ->setSound("default")
    ->setBadge(11)
    ->setBody($messages);

// Shortcut function:
#$notification = $client->pushNotification('The title', 'The body', $deviceId);
#print_r($notification);
$response = $client->send($notification);

  
      
    #header('location:open.php?r=1&id='.$receiver);
    #exit;
    echo "1";
  }else{
    #header('location:open.php?r=0&id='.$receiver);
    #exit;
    echo "0";
  }
?>
