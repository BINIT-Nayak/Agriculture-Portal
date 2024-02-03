<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
//echo phpinfo();
require_once("class.phpmailer.php");
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); // create a new object
	$mail->isSMTP(); // enable SMTP
	$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = "smtp.example.com";
	$mail->Port = 587; // or 465
	$mail->isHTML(true);
	$mail->Username = "binit.20bce7420@vitap.ac.in";
	$mail->Password = "Icse@2018";
	$mail->SetFrom("enquiry@marchingants.net");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->Send()){
		echo "Mailer Error: " . $mail->ErrorInfo;
	}else{
		echo "Message has been sent";
	}
}
smtp_mailer('legendnayak48@gmail.com',"Test","testing")
?>
</body>
</html>