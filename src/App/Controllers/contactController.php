<?php
namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class contactController
{
    public function index(): void
    {
        $error   = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre       = trim($_POST['titre'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $email       = trim($_POST['email'] ?? '');

            if (empty($titre) || empty($description) || empty($email)) {
                $error = 'Veuillez remplir tous les champs.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "L'adresse email n'est pas valide.";
            } else {
                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $_ENV['MAIL_USER'];
                    $mail->Password   = $_ENV['MAIL_PASSWORD'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
                    $mail->CharSet    = 'UTF-8';
                    $mail->setFrom($_ENV['MAIL_USER'], 'Vite & Gourmand - Contact');
                    $mail->addAddress($_ENV['MAIL_USER']);
                    $mail->addReplyTo($email);
                    $mail->Subject = 'Nouveau message de contact : ' . $titre;
                    $mail->Body    = "Message de : $email\n\n$description";
                    $mail->send();

                    $success = 'Votre message a bien été envoyé.';
                } catch (Exception $e) {
                    $error = "Erreur lors de l'envoi du message.";
                }
            }
        }

        $pageTitle = 'Contact';
        require __DIR__ . '/../../../View/pages/contact.php';
    }
}