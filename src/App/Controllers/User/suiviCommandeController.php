<?php
namespace App\Controllers\User;

use App\App;
use App\Middleware\AuthMiddleware;

class suiviCommandeController
{
    public function index(): void
    {
        AuthMiddleware::checkClient();
        $numero = $_GET['numero'] ?? null;

        if (!$numero) {
            header('Location: index.php?p=commandes');
            exit;
        }

        $commandeTable = App::getInstance()->getTable('commande');
        $commande = $commandeTable->findParNumero($numero, $_SESSION['utilisateur_id']);

        if (!$commande) {
            header('Location: index.php?p=commandes');
            exit;
        }

        $historique = $commandeTable->findHistorique($numero); 
        $pageTitle  = 'Suivi de commande';
        require __DIR__ . '/../../../../View/pages/user/suivi-commande.php';
    }
}