<?php
session_start();

error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

if (!array_key_exists('error_reporting', $_SESSION)) {
    $_SESSION['error_reporting'] = [];
}

if (!array_key_exists('formData', $_SESSION) || array_key_exists('formData', $_SESSION)) {
    $_SESSION['formData'] = [];
}

if (isset($_POST['submit'])) {
    $_SESSION['formData'] = array(
        "name" => $_POST['name'],
        "emailaddress" => $_POST['emailaddress'],
        "description" => $_POST['description']
    );
}

require_once "../src/logs/vendor/autoload.php";
require_once '../src/phpmailer/vendor/autoload.php';

//phpMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//monolog
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['emailaddress']) && !empty($_POST['description'])) {
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $emailaddress = htmlspecialchars(strip_tags($_POST['emailaddress']));
        $description = htmlspecialchars(strip_tags($_POST['description']));

        // constants
        $senderMailAddress = "";
        $homepage = "location:../klachtenformulier/index.php";

        $mail = new PHPMailer(true);
        try {

            //Sends mail to client
            //Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $senderMailAddress;
            $mail->Password   = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //Recipients 
            $mail->setFrom($senderMailAddress);
            $mail->addAddress($emailaddress, $name);
            $mail->addCC($senderMailAddress);

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Uw klacht is in behandeling';
            $mail->Body    = $description;

            $mail->send();

            // logs userdata
            $logger = new Logger('info');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/info.log', Level::Debug));
            $logger->info('user data:', ['name' => $name, 'emailaddress' => $emailaddress, 'description' => $description]);

            $_SESSION['error_reporting'] = array("status" => "succesfull", "message" => "Message has been sent");
            header($homepage);
        } catch (Exception $e) {
            $_SESSION['error_reporting'] = array("status" => "failed", "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            header($homepage);
        }
    }
} else {
    $_SESSION['error_reporting'] = array("status" => "failed", "message" => "Message could not be sent!");
    header($homepage);
}
