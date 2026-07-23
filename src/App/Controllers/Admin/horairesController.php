<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;

class horairesController
{
    public function index(): void
    {
        AuthMiddleware::checkAdmin();

        $horaireTable = App::getInstance()->getTable('horaire');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['horaire_id'])) {
            $ouverture = trim($_POST['heure_ouverture'] ?? '');
            $fermeture = trim($_POST['heure_fermeture'] ?? '');

        if (empty($ouverture) || empty($fermeture)) {
            $_SESSION['error'] = 'Veuillez remplir les deux horaires.';
        } else {
            $horaireTable->modifier((int) $_POST['horaire_id'], $ouverture, $fermeture);
        }

        header('Location: index.php?p=horaires');
        exit;
        
        }

        $horaires  = $horaireTable->findAll();
        $pageTitle = 'Horaires';

        require __DIR__ . '/../../../../View/pages/admin/horaires.php';
    }
}
