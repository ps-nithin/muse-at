<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';



function sendOTP($otp,$email){
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'localhost';
$mail->Port = 25;
$mail->SMTPAuth = false;
$mail->smtpConnect([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);
$mail->Username = 'help@muse-at.com';
$mail->Password = 'mail@museat';
$mail->setFrom('help@muse-at.com');
$mail->addReplyTo('help@muse-at.com');
$mail->addAddress($email);
$mail->Subject = 'muse-at';
$mail->Body = "Your OTP is $otp.";
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}

}

?>