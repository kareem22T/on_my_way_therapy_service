<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

trait SendEmail
{

    public function sendEmail($receiver_mail, $msg_title, $msg_content)
    {

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'info@onmywaytherapy.com.au'; //SMTP username
            $mail->Password = 'gnvuxkgwibpgekrx'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 465;
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('info@onmywaytherapy.com.au', 'On MY Way Therapy Service');
            $mail->addAddress($receiver_mail); //Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = $msg_title;
            $mail->Body = $msg_content;
            $mail->SMTPDebug = 2;
            ob_start();
            $mail->send();
            $responsePayload = ob_get_clean();
            $mail->SMTPDebug = 0;
        } catch (Exception $e) {
            return [
                'status' => 500
            ];
        }
    }
}
