<?php

class Contact{

public static function SendMail($fromName, $studentNumber, $inputMessage){
require_once('PHPMAILER/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->Host       = "mail.noirenex.com"; // sets the SMTP server
  $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
  $mail->Username   = "admin@cp3049.noirenex.com"; // SMTP account username
  $mail->Password   = "4dm1n";        // SMTP account password
  $mail->AddReplyTo('d.dawes@wlv.ac.uk', 'Wolverine Admin');
  $mail->AddAddress('d.dawes@wlv.ac.uk', 'Wolverine Admin'); //TO
  $mail->SetFrom('admin@cp3049.noirenex.com', 'Wolverine Admin');
  $mail->Subject = 'Wolverine - New Message';
  $message = "<h2>Message from the website!</h2>";
  $message .= "<p>Name: ".$fromName."</p>";
  $message .= "<p>Student ID: ".$studentNumber."</p>";
  $message .= "<p>Details: ".$inputMessage."</p>";
  
  $mail->MsgHTML($message);
  $mail->Send();
  return "Your message has been sent.!";
} catch (phpmailerException $e) {
  return $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  return $e->getMessage(); //Boring error messages from anything else!
}
}
}
?>