<?php
namespace App\Controllers\Employe;

use App\App;
use App\Middleware\AuthMiddleware;

class platsController
{
    public function index(): void
    {
        AuthMiddleware::checkEmploye();
        $platTable = App::getInstance()->getTable('plat');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'ajouter' && !empty($_POST['titre']) && !empty($_FILES['avatar']['name'])) {
                $titre = trim($_POST['titre']);
                $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];
                $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));

                if (!in_array($extension, $extensionsAutorisees)) {
                    die('Format de fichier non autorisé.');
                }
                if ($_FILES['avatar']['size'] > 5 * 1024 * 1024) {
                    die('Fichier trop volumineux (max 5 Mo).');
                }

                $photo = file_get_contents($_FILES['avatar']['tmp_name']);
                $platTable->creer($titre, $photo);
                header('Location: index.php?p=employe-plats');
                exit;
            }

            if ($action === 'modifier' && !empty($_POST['plat_id'])) {
                $plat_id = (int) $_POST['plat_id'];
                $titre   = trim($_POST['titre']);

                if (!empty($_FILES['avatar']['name'])) {
                    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];
                    $extension = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));

                    if (!in_array($extension, $extensionsAutorisees)) {
                        die('Format de fichier non autorisé.');
                    }

                    $photo = file_get_contents($_FILES['avatar']['tmp_name']);
                    $platTable->modifier($plat_id, $titre, $photo);
                } else {
                    $platTable->modifierTitre($plat_id, $titre);
                }
                header('Location: index.php?p=employe-plats');
                exit;
            }

            if ($action === 'supprimer' && !empty($_POST['plat_id'])) {
                $platTable->supprimer((int) $_POST['plat_id']);
                header('Location: index.php?p=employe-plats');
                exit;
            }
        }

        $plats     = $platTable->findAll();
        $pageTitle = 'Plats';
        require __DIR__ . '/../../../../View/pages/employe/plats.php';
    }
}