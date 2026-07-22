<?php
namespace App\Controllers;

use App\App;

class loginController
{
    public function index(): void
    {
        $error = '';

        if (!empty($_GET['timeout'])) {
            $error = 'Votre session a expiré par inactivité. Veuillez vous reconnecter.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = 'Veuillez remplir tous les champs.';
            } else {
                $utilisateurTable = App::getInstance()->getTable('utilisateur');
                $user = $utilisateurTable->findByEmail($email);

                if (!$user) {
                    if ($utilisateurTable->emailExiste($email)) {
                        $error = 'Ce compte a été désactivé. Contactez l\'administrateur.';
                    } else {
                        $error = 'Email ou mot de passe incorrect.';
                    }
                } elseif (password_verify($password, $user['password'])) {
                    $_SESSION['utilisateur_id']   = $user['utilisateur_id'];
                    $_SESSION['email']            = $user['email'];
                    $_SESSION['role_id']          = (int) $user['role_id'];
                    $_SESSION['doit_changer_mdp'] = (int) ($user['doit_changer_mdp'] ?? 0);

                    if ($_SESSION['doit_changer_mdp']) {
                        header('Location: /vitegourmand/public/index.php?p=changer-mdp');
                        exit;
                    }

                    $redirect = $_GET['redirect'] ?? '';

                    if ($redirect === 'commande' && (int) $user['role_id'] === 2) {
                        header('Location: /vitegourmand/public/index.php?p=commande&menu_id=' . (int) ($_GET['menu_id'] ?? 0));
                    } elseif ((int) $user['role_id'] === 1) {
                        header('Location: /vitegourmand/public/index.php?p=admin-dashboard');
                    } elseif ((int) $user['role_id'] === 3) {
                        header('Location: /vitegourmand/public/index.php?p=employe-commandes');
                    } else {
                        header('Location: /vitegourmand/public/index.php?p=commandes');
                    }
                    exit;
                } else {
                    $error = 'Email ou mot de passe incorrect.';
                }
            }
        }

        require __DIR__ . '/../../../View/pages/login.php';
    }
}