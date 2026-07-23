<?php
namespace App\Controllers;

use App\App;

class changerMdpController
{
    public function index(): void
    {
        if (empty($_SESSION['utilisateur_id'])) {
            header('Location: /index.php?p=login');
            exit;
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password         = trim($_POST['password'] ?? '');
            $password_confirm = trim($_POST['password_confirm'] ?? '');

            if (empty($password) || empty($password_confirm)) {
                $error = 'Veuillez remplir tous les champs.';
            } elseif (strlen($password) < 10) {
                $error = 'Le mot de passe doit contenir au moins 10 caractères.';
            } elseif ($password !== $password_confirm) {
                $error = 'Les mots de passe ne sont pas identiques.';
            } else {
                $utilisateurTable = App::getInstance()->getTable('utilisateur');
                $utilisateurTable->changerMotDePasse((int) $_SESSION['utilisateur_id'], $password);
                $utilisateurTable->setDoitChangerMdp((int) $_SESSION['utilisateur_id'], 0);
                $_SESSION['doit_changer_mdp'] = 0;

                if ((int) $_SESSION['role_id'] === 1) {
                    header('Location: /index.php?p=admin-dashboard');
                } elseif ((int) $_SESSION['role_id'] === 3) {
                    header('Location: /index.php?p=employe-commandes');
                } else {
                    header('Location: /index.php?p=commandes');
                }
                exit;
            }
        }

        require __DIR__ . '/../../../View/pages/changer-mdp.php';
    }
}
