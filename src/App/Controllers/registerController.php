<?php
namespace App\Controllers;

use App\App;
use App\Table\UtilisateurTable;

class registerController
{
    public function index(): void
    {
        $error   = $_SESSION['error']   ?? '';
        $success = $_SESSION['success'] ?? '';
        unset($_SESSION['error'], $_SESSION['success']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $nom        = trim($_POST['nom'] ?? '');
            $prenom     = trim($_POST['prenom'] ?? '');
            $telephone  = trim($_POST['telephone'] ?? '');
            $numero_rue = trim($_POST['numero_rue'] ?? '');
            $rue        = trim($_POST['rue'] ?? '');
            $adresse_complementaire = trim($_POST['adresse_complementaire'] ?? '');
            $code       = trim($_POST['code_postale'] ?? '');
            $ville      = trim($_POST['ville'] ?? '');
            $email      = trim($_POST['email'] ?? '');
            $password   = trim($_POST['password'] ?? '');
            $password_confirm = trim($_POST['password_confirm'] ?? '');

            if (!$nom || !$prenom || !$telephone || !$numero_rue || !$rue || !$code || !$ville || !$email || !$password || !$password_confirm) {
                $error = 'Veuillez remplir tous les champs.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "L'adresse email n'est pas valide.";
            } elseif (strlen($password) < 10) {
                $error = 'Le mot de passe doit contenir au moins 10 caractères.';
            } elseif ($password !== $password_confirm) {
                $error = 'Les mots de passe ne sont pas identiques.';
            } else {
                $utilisateurTable = App::getInstance()->getTable('utilisateur');

                if ($utilisateurTable->emailExiste($email)) {
                    $error = 'Cet email est déjà utilisé.';
                } else {
                    $utilisateurTable->creer($nom, $prenom, $telephone, $numero_rue, $rue, $adresse_complementaire, $code, $ville, $email, $password);
                    $_SESSION['success'] = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
                    $suite = '';
                    if (isset($_GET['redirect'])) {
                        $suite = '&redirect=' . urlencode($_GET['redirect']) . '&menu_id=' . (int) ($_GET['menu_id'] ?? 0);
                    }
                    header('Location: index.php?p=login' . $suite);
                    exit;
                }
            }
        }

        require __DIR__ . '/../../../View/pages/register.php';
    }
}
