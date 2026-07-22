<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;

class clientsController
{
    public function index(): void
    {
        AuthMiddleware::checkAdmin();
        $utilisateurTable = App::getInstance()->getTable('utilisateur');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if (in_array($action, ['bloquer', 'debloquer']) && !empty($_POST['utilisateur_id'])) {
                $actif = ($action === 'debloquer') ? 1 : 0;
                $utilisateurTable->setActif((int) $_POST['utilisateur_id'], $actif);
                header('Location: index.php?p=admin-clients');
                exit;
            }
        }

        $clients   = $utilisateurTable->findClients();
        $pageTitle = 'Gestion des clients';
        require __DIR__ . '/../../../../View/pages/admin/clients.php';
    }

    public function detail(): void
    {
        AuthMiddleware::checkAdmin();
        $id = (int) ($_GET['id'] ?? 0);

        $utilisateurTable = App::getInstance()->getTable('utilisateur');
        $client = $utilisateurTable->find($id);

        if (!$client || (int) $client['role_id'] !== 2) {
            header('Location: index.php?p=admin-clients');
            exit;
        }

        $commandes = App::getInstance()->getTable('commande')->findParUtilisateur($id);
        $pageTitle = 'Détail du client';
        require __DIR__ . '/../../../../View/pages/admin/client-detail.php';
    }
}
