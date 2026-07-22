<?php
namespace App\Controllers;

use App\App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class forgotPasswordController
{
    public function index(): void
    {
        $message = '';
        $error   = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Veuillez entrer une adresse email valide.';
            } else {
                $utilisateurTable    = App::getInstance()->getTable('utilisateur');
                $passwordResetTable  = App::getInstance()->getTable('passwordReset');
                $user = $utilisateurTable->findByEmail($email);

                if ($user) {
                    $token = bin2hex(random_bytes(32));
                    $passwordResetTable->creerToken($user['utilisateur_id'], $token);

                    $lien = 'http://localhost/vitegourmand/public/index.php?p=reset-password&token=' . $token;

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
                        $mail->setFrom('vitegourmand.info@gmail.com', 'Vite & Gourmand');
                        $mail->addAddress($email);
                        $mail->Subject = 'Réinitialisation de votre mot de passe';
                        $mail->Body    = "Bonjour,\n\nCliquez sur ce lien pour réinitialiser votre mot de passe :\n\n$lien\n\nCe lien expire dans 1 heure.";
                        $mail->send();
                    } catch (Exception $e) {
                        $error = 'Erreur envoi email : ' . $mail->ErrorInfo;
                    }
                }
                if (!$error) {
                    $message = 'Un email a été envoyé si ce compte existe.';
                }
            }
        }

        require __DIR__ . '/../../../View/pages/forgot-password.php';
    }
}
