<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function SendMail($email, $bodytemplate, $subject)
{
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'caballeroaldrin02@gmail.com';
        $mail->Password = 'psfgjxovixwhnjtd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->setFrom('caballeroaldrin02@gmail.com', 'Swiftlink', true);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;

        // email body template
        $mail->Body = $bodytemplate;

        $mail->send();
    } catch (Exception $e) {
        return false;
    }
    return true;
}
