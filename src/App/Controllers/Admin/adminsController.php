<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;
use App\Mail\Mailer;

class adminsController
{
    private function genererMotDePasse(): string
    {
        $caracteres = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $motDePasse = '';

        for ($i = 0; $i < 12; $i++) {
            $motDePasse .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        return $motDePasse;
    }

    public function index(): void
    {
        AuthMiddleware::checkAdmin();
        $utilisateurTable = App::getInstance()->getTable('utilisateur');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'creer' && !empty($_POST['email'])) {
                $nom    = trim($_POST['nom'] ?? '');
                $prenom = trim($_POST['prenom'] ?? '');
                $email  = trim($_POST['email']);

                if (!$nom || !$prenom || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = 'Veuillez remplir correctement tous les champs.';
                } elseif ($utilisateurTable->emailExiste($email)) {
                    $_SESSION['error'] = 'Cet email est déjà utilisé.';
                } else {
                    $motDePasseTemporaire = $this->genererMotDePasse();
                    $utilisateurTable->creerAdmin($nom, $prenom, $email, $motDePasseTemporaire);

                    $mailEnvoye = Mailer::envoyer(
                        $email,
                        'Votre compte administrateur Vite & Gourmand',
                        "Bonjour $prenom,\n\nVotre compte administrateur a été créé.\n\nEmail : $email\nMot de passe temporaire : $motDePasseTemporaire\n\nVous devrez changer ce mot de passe lors de votre première connexion.\n\nBonne journée !"
                    );

                    if ($mailEnvoye) {
                        $_SESSION['success'] = 'Compte administrateur créé, les identifiants ont été envoyés par email à ' . $email . '.';
                    } else {
                        $_SESSION['success'] = 'Compte administrateur créé, mais l\'email n\'a pas pu être envoyé. Mot de passe temporaire à communiquer manuellement : ' . $motDePasseTemporaire;
                    }
                }
                header('Location: index.php?p=admin-admins');
                exit;
            }

            if (in_array($action, ['activer', 'desactiver']) && !empty($_POST['utilisateur_id'])) {
                $id = (int) $_POST['utilisateur_id'];
                if ($action === 'desactiver' && $utilisateurTable->compterAdminsActifs() <= 1) {
                    $_SESSION['error'] = 'Impossible de désactiver le dernier administrateur actif.';
                } else {
                    $utilisateurTable->setActif($id, $action === 'activer' ? 1 : 0);
                }
                header('Location: index.php?p=admin-admins');
                exit;
            }
        }

        $error   = $_SESSION['error'] ?? '';
        $success = $_SESSION['success'] ?? '';
        unset($_SESSION['error'], $_SESSION['success']);

        $admins    = $utilisateurTable->findAdmins();
        $pageTitle = 'Administrateurs';
        require __DIR__ . '/../../../../View/pages/admin/admins.php';
    }
}
