<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

function mailer($subject,$message){
$config = parse_ini_file("../Private/config.ini");
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = $config['MAILHOST'];
$mail->Username = $config['USERNAME'];
$mail->Password = $config['PASSWORD'];
$mail->SMTPSecure = 'ssl'; // or PHPMailer :: ENCRYPTION_STARTTLS; in case your ISP didnt block that port.
$mail->Port=465; //or 587; 
$mail->setFrom($config['SEND_FROM'],$config['SEND_FROM_NAME']);
// $mail->SMTPDebug=3;
$mail->addAddress($_SESSION['email']);
$mail->Subject = ($subject);
$mail->Body = $message;

$mail->send();
}
?>




