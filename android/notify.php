<?php

require 'vendor/autoload.php';


function sendNotification($username,$message){
require('mysql_conn.php');
$client = new \Fcm\FcmClient('AAAAAgwfQzw:APA91bFXh8r8k9veJhve3cBNpPE9tL2ZOen2Uk9AqPuA_re85VMJsJbc6_knKouFzZ61K3arrLoOHGzMHo7liMp1VdxBMAHX9z2QVzlq7jG-plM4gwK6zmVJ1I3B0uEjVxNYmJetWFdg','8793310012');

$notification = new \Fcm\Push\Notification();
$res=$conn->query("select token_id from users where username='$username';");
$row=$res->fetch_assoc();
$deviceId=$row['token_id'];
#echo $deviceId;
$notification
    ->addRecipient($deviceId)
    ->setTitle($username)
    ->setColor('#20F037')
    ->setSound("default")
    ->setBadge(11)
    ->addData("$username",$message);

// Shortcut function:
#$notification = $client->pushNotification('The title', 'The body', $deviceId);
#print_r($notification);
$response = $client->send($notification);
#print_r($response);
}
?>