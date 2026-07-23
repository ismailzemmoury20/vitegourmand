<?php
namespace App\Controllers\Employe;

use App\App;
use App\Middleware\AuthMiddleware;

class horairesController
{
    public function index(): void
    {
        AuthMiddleware::checkEmploye();

        $horaireTable = App::getInstance()->getTable('horaire');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['horaire_id'])) {
            if (!empty($_POST['ferme'])) {
                $ouverture = 'fermé';
                $fermeture = 'fermé';
            } else {
                $ouverture = $_POST['heure_ouverture'] ?? '';
                $fermeture = $_POST['heure_fermeture'] ?? '';
            }
            $horaireTable->modifier((int) $_POST['horaire_id'], $ouverture, $fermeture);
            header('Location: index.php?p=employe-horaires');
            exit;
        }

        $horaires  = $horaireTable->findAll();
        $pageTitle = 'Horaires';

        require __DIR__ . '/../../../../View/pages/employe/horaires.php';
    }
}
