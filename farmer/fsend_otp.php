<?php
session_start();
require('../sql.php'); // Includes Login Script

require "./PHPMailer-master/src/PHPMailer.php";
require "./PHPMailer-master/src/SMTP.php";
require "./PHPMailer-master/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$email=$_SESSION['farmer_login_user'];
$res=mysqli_query($conn,"select * from farmerlogin where email='$email'");
$count=mysqli_num_rows($res);
if($count>0){
    $otp=rand(11111,99999);
    mysqli_query($conn,"update farmerlogin set otp='$otp' where email ='$email'");
	$html="Your otp verification code for Agriculture Portal as farmer is ".$otp;
	$_SESSION['farmer_login_user'];
    // smtp_mailer($email,'OTP Verification',$html); 
	sendMail($email, $otp, $html);
    echo "yes";
}
else{
    echo "not exist"; 
}
 
// function smtp_mailer($to,$subject, $msg){
// 	require_once("../smtp/class.phpmailer.php");
// 	$mail = new PHPMailer(true); 
// 	$mail->isSMTP(); 
// 	$mail->SMTPDebug = 0; 
// 	$mail->SMTPAuth = TRUE; 
// 	$mail->SMTPSecure = 'ssl'; 
// 	$mail->Host = "smtp.gmail.com";
// 	$mail->Port = 587; 
// 	$mail->IsHTML(true);
// 	$mail->CharSet = 'UTF-8';
// 	$mail->Username = "abhijeetbosedas8@gmail.com";   
//     $mail->Password = "bhswtjmnlslgefkl";  //Abhijit@2001	
//     $mail->SetFrom("abhijeetbosedas8@gmail.com");  //bhswtjmnlslgefkl bhsw tjmn lslg efkl
// 	$mail->Subject = $subject;
// 	$mail->Body =$msg;
// 	$mail->AddAddress($to);
// 	if(!$mail->Send()){
// 		return 0;
// 	}else{
// 		return 1;
// 	}
// }

function sendMail($send_to, $otp, $html) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Enter your email ID
    $mail->Username = "legendnayak48@gmail.com";
    $mail->Password = "gixqcujlqgepmcls";

    // Your email ID and Email Title
    $mail->setFrom("legendnayak48@gmail.com", "The Harvest");

    $mail->addAddress($send_to);

    // You can change the subject according to your requirement!
    $mail->Subject = "OTP Verification";

    // You can change the Body Message according to your requirement!
    $mail->Body = $html;
    $mail->send();
}
?>

