<?php

namespace IziDev\MiniFramework\Boot;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public function __invoke($from, $subject, $body)
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $_SERVER["EMAIL_HOST"];
        $mail->SMTPAuth = true;
        $mail->Username = $_SERVER["EMAIL_USERNAME"];
        $mail->Password = $_SERVER["EMAIL_PASSWORD"];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_SERVER["EMAIL_PORT"];

        $mail->setFrom($_SERVER["EMAIL_FROM"], $_SERVER["EMAIL_NAME"]);
        $mail->addAddress($from["email"], $from["name"]);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->send();
    }
}