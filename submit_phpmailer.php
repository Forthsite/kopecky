<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  die("Direct access to this script is not allowed.");
}

$honey = $_POST['url'];

if (!empty($honey)){
  exit;
}

$name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$sub = htmlspecialchars($_POST["predmet"], ENT_QUOTES, 'UTF-8');
$usermessage = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');


$mail = new PHPMailer(true);

try {
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.seznam.cz';                       // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = 'forthsitemailer@email.cz';                   // SMTP username
  $mail->Password   = '7wg6nvumforthsite';                         // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       // Enable TLS encryption
  $mail->Port       = 587;                                    // TCP port to connect to

  // Recipients
  $mail->setFrom('forthsitemailer@email.cz', 'Forthsite - mirizol-hydroizolace.cz');
  $mail->addAddress('mirizol@seznam.cz', 'Mirizol');  // Add a recipient


  // Content
  $mail->CharSet = 'UTF-8';
  $mail->isHTML(false);                                        // Set email format to HTML
  $mail->Subject = 'Nova poptavka z webu mirizol-hydroizolace.cz';
  $mail->Body    = "Jméno: $name\nEmail: $email\nZpráva: $usermessage";

    // Send the email
    if ($mail->send()) {
      header("Location: https://www.mirizol-hydroizolace.cz/");
  } else {
      echo "CHYBA - odeslání se nepovedlo";
  }
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>