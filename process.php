<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inahitaji Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['form_fields']['name']);
    $email = htmlspecialchars($_POST['form_fields']['email']);
    $phone = htmlspecialchars($_POST['form_fields']['field_60736e3']);
    $message = htmlspecialchars($_POST['form_fields']['message']);

    $mail = new PHPMailer(true);

    try {
        // Set up SMTP kwa Zoho Mail
        $mail->isSMTP();
        $mail->Host = 'smtp.zoho.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'support@nyumbachap.com'; // Email yako ya Zoho
        $mail->Password = 'vGdFWkYjDx9e'; // Weka App Password ya Zoho
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set email details
        $mail->setFrom('support@nyumbachap.com', 'NyumbaChap Support');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('support@nyumbachap.com'); // Email unayopokea ujumbe

        $mail->Subject = "Ujumbe Mpya kutoka $name";
        $mail->Body = "Jina: $name\nEmail: $email\nNamba ya Simu: $phone\n\nUjumbe:\n$message";

        $mail->send();
        echo "Ujumbe umetumwa kwa mafanikio!";
    } catch (Exception $e) {
        echo "Samahani, ujumbe haujatumwa. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Tafadhali tumia fomu kutuma ujumbe.";
}
?>
