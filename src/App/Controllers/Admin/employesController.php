<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;
use App\Mail\Mailer;

class employesController
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

            if (in_array($action, ['activer', 'desactiver']) && !empty($_POST['utilisateur_id'])) {
                $actif = ($action === 'activer') ? 1 : 0;
                $utilisateurTable->setActif((int) $_POST['utilisateur_id'], $actif);
                header('Location: index.php?p=admin-employes');
                exit;
            }

            if ($action === 'creer' && !empty($_POST['email'])) {
                $nom    = trim($_POST['nom'] ?? '');
                $prenom = trim($_POST['prenom'] ?? '');
                $email  = trim($_POST['email']);
                $mpd    = trim($_POST['mpd'] ?? '');

                if (!$nom || !$prenom || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($mpd) < 8) {
                    $_SESSION['error'] = 'Veuillez remplir correctement tous les champs (mot de passe : 8 caractères minimum).';
                } elseif ($utilisateurTable->emailExiste($email)) {
                    $_SESSION['error'] = 'Cet email est déjà utilisé.';
                } else {
                    $utilisateurTable->creerEmploye($nom, $prenom, $email, $mpd);

                    Mailer::envoyer(
                        $email,
                        'Votre compte employé Vite & Gourmand',
                        "Bonjour $prenom,\n\nVotre compte employé a été créé.\n\nEmail : $email\n\nMerci de vous rapprocher de l'administrateur pour obtenir votre mot de passe.\n\nBonne journée !"
                    );

                    $_SESSION['success'] = 'Compte employé créé.';
                }
                header('Location: index.php?p=admin-employes');
                exit;
            }

            if ($action === 'modifier' && !empty($_POST['utilisateur_id'])) {
                $id     = (int) $_POST['utilisateur_id'];
                $nom    = trim($_POST['nom'] ?? '');
                $prenom = trim($_POST['prenom'] ?? '');
                $email  = trim($_POST['email'] ?? '');

                if (!$nom || !$prenom || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = 'Veuillez remplir correctement tous les champs.';
                } elseif ($utilisateurTable->emailExistePourAutre($email, $id)) {
                    $_SESSION['error'] = 'Cet email est déjà utilisé.';
                } else {
                    $utilisateurTable->modifierEmploye($id, $nom, $prenom, $email);
                    $_SESSION['success'] = 'Informations de l\'employé mises à jour.';
                }
                header('Location: index.php?p=admin-employes');
                exit;
            }

            if ($action === 'reinitialiser' && !empty($_POST['utilisateur_id'])) {
                $id       = (int) $_POST['utilisateur_id'];
                $employe  = $utilisateurTable->find($id);

                if ($employe) {
                    $motDePasseTemporaire = $this->genererMotDePasse();
                    $utilisateurTable->changerMotDePasse($id, $motDePasseTemporaire);
                    $utilisateurTable->setDoitChangerMdp($id, 1);

                    Mailer::envoyer(
                        $employe['email'],
                        'Réinitialisation de votre mot de passe Vite & Gourmand',
                        "Bonjour {$employe['prenom']},\n\nVotre mot de passe a été réinitialisé.\n\nMerci de vous rapprocher de l'administrateur pour obtenir votre nouveau mot de passe.\n\nBonne journée !"
                    );

                    $_SESSION['success'] = "Mot de passe réinitialisé. Nouveau mot de passe temporaire à communiquer à l'employé : $motDePasseTemporaire";
                }
                header('Location: index.php?p=admin-employes');
                exit;
            }
        }

        $error   = $_SESSION['error'] ?? '';
        $success = $_SESSION['success'] ?? '';
        unset($_SESSION['error'], $_SESSION['success']);

        $employes  = $utilisateurTable->findEmployes();
        $pageTitle = 'Gestion des employés';
        require __DIR__ . '/../../../../View/pages/admin/employes.php';
    }
}
