<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;

class avisClientsController
{
    public function index(): void
    {
        AuthMiddleware::checkAdmin();
        $avisTable = App::getInstance()->getTable('avis');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['avis_id'])) {
            $action  = $_POST['action'] ?? '';
            $avis_id = (int) $_POST['avis_id'];

            if ($action === 'valider') {
                $avisTable->valider($avis_id);
            } elseif ($action === 'refuser') {
                $avisTable->refuser($avis_id);
            } elseif ($action === 'supprimer') {
                $avisTable->supprimer($avis_id);
            }

            header('Location: index.php?p=avis-clients');
            exit;
        }

        $avis      = $avisTable->findAll();
        $pageTitle = 'Avis clients';
        require __DIR__ . '/../../../../View/pages/admin/avis-clients.php';
    }
}