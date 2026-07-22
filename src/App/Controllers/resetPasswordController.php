<?php
namespace App\Controllers;

use App\App;
use App\Middleware\AuthMiddleware;
use App\Table\PasswordResetTable;

class resetPasswordController
{
    public function index(): void
    {
        $token   = $_GET['token'] ?? '';
        $message = '';
        $error   = '';

        if (empty($token)) {
            die('Lien invalide.');
        }

        $passwordResetTable = App::getInstance()->getTable('passwordReset');
        $reset = $passwordResetTable->findToken($token);

        if (!$reset) {
            die('Lien invalide ou expiré.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password         = trim($_POST['password']         ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');

            if (empty($password) || empty($confirm_password)) {
                $error = 'Veuillez remplir tous les champs.';
            } elseif (strlen($password) < 8) {
                $error = 'Le mot de passe doit contenir au moins 8 caractères.';
            } elseif ($password !== $confirm_password) {
                $error = 'Les mots de passe ne correspondent pas.';
            } else {
                $utilisateurTable = App::getInstance()->getTable('utilisateur');
                $hash = password_hash($password, PASSWORD_BCRYPT);

                App::getInstance()->getDb()->getPDO()
                    ->prepare('UPDATE utilisateur SET password = ? WHERE utilisateur_id = ?')
                    ->execute([$hash, $reset['user_id']]);

                $passwordResetTable->utiliserToken($reset['id']);
                $message = 'Mot de passe mis à jour avec succès !';
            }
        }

        require __DIR__ . '/../../../View/pages/reset-password.php';
    }
}
