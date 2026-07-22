<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;

class commandesController
{
    public function index(): void
    {
        AuthMiddleware::checkAdmin();
        $commandeTable = App::getInstance()->getTable('commande');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'modifier_statut' && !empty($_POST['numero_commande']) && !empty($_POST['statut'])) {
                $commandeTable->modifierStatut($_POST['numero_commande'], $_POST['statut']);
                header('Location: index.php?p=commandes');
                exit;
            }

            if ($action === 'annuler' && !empty($_POST['numero_commande'])) {
                $mode_contact = trim($_POST['mode_contact'] ?? '');
                $motif        = trim($_POST['motif'] ?? '');

                if (empty($mode_contact) || empty($motif)) {
                    $_SESSION['error'] = 'Veuillez indiquer le mode de contact et le motif d\'annulation.';
                } else {
                    $commandeTable->annuler($_POST['numero_commande'], $mode_contact, $motif);
                }
                header('Location: index.php?p=commandes');
                exit;
            }
        }

        $error   = $_SESSION['error'] ?? '';
        unset($_SESSION['error']);
        $search    = $_GET['commande'] ?? '';
        $statut    = $_GET['statut']   ?? '';
        $commandes = $commandeTable->rechercher($search, $statut);
        $pageTitle = 'Commandes';
        require __DIR__ . '/../../../../View/pages/admin/commandes.php';
    }
}