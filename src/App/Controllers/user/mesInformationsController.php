<?php
namespace App\Controllers\User;

use App\App;
use App\Middleware\AuthMiddleware;

class mesInformationsController
{
    public function index(): void
    {
        AuthMiddleware::checkClient();

        $utilisateurTable = App::getInstance()->getTable('utilisateur');
        $error   = $_SESSION['error']   ?? '';
        $success = $_SESSION['success'] ?? '';
        unset($_SESSION['error'], $_SESSION['success']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
            $password_actuel  = trim($_POST['password_actuel'] ?? '');
            $password_nouveau = trim($_POST['password_nouveau']?? '');

            $user = $utilisateurTable->find($_SESSION['utilisateur_id']);

            if ($user && password_verify($password_actuel, $user['password'])) {
                $utilisateurTable->changerMotDePasse($_SESSION['utilisateur_id'], $password_nouveau);
                $_SESSION['success'] = 'Informations mises à jour avec succès.';
            } else {
                $_SESSION['error'] = 'Le mot de passe actuel est incorrect.';
            }
            header('Location: index.php?p=mes-informations');
            exit;
        }

        $user      = $utilisateurTable->find($_SESSION['utilisateur_id']);
        $pageTitle = 'Mes informations';

        require __DIR__ . '/../../../../View/pages/user/mes-informations.php';
    }
}
