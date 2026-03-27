<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = 'EMAILI_JOT@gmail.com';
        $mail->Password = 'APP_PASSWORD';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('EMAILI_JOT@gmail.com', 'Website Contact');
        $mail->addAddress('EMAILI_JOT@gmail.com');

        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Neue Kontaktanfrage';

        $mail->Body = "
        <h2>Neue Nachricht vom Kontaktformular</h2>

        <b>Name:</b> $name <br>
        <b>Email:</b> $email <br>
        <b>Telefon:</b> $phone <br>
        <b>Dienstleistung:</b> $service <br><br>

        <b>Nachricht:</b><br>
        $message
        ";

        $mail->send();

        header("Location: contact.php?status=success");
    } catch (Exception $e) {

        header("Location: contact.php?status=error");
    }
}
