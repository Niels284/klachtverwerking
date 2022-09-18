<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['emailadres']) && !empty($_POST['describtion'])) {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $emailadres = htmlspecialchars(strip_tags($_POST['emailadres']));
        $describtion = htmlspecialchars(strip_tags($_POST['describtion']));

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'example@gmail.com';                     //SMTP username
            $mail->Password   = '';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('example@gmail.com');
            $mail->addAddress($emailadres);     //Add a recipient
            $mail->addCC('example@gmail.com');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Uw klacht is in behandeling';
            $mail->Body    = $describtion;

            $mail->send();
            echo '<script>alert("Message has been sent")</script>';
            header('location:../klachtenformulier/index.php');
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
            header('location:../klachtenformulier/index.php');
        }
    }
} else {
    echo '<script>alert("Message could not be sent!!")</script>';
    header('location:../klachtenformulier/index.php');
}
