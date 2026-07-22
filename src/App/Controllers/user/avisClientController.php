<?php
namespace App\Controllers\User;

use App\App;
use App\Middleware\AuthMiddleware;

class avisClientController
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

        if (!$commande || $commande['statut'] !== 'terminée') {
            header('Location: index.php?p=commandes');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note        = (int) ($_POST['note'] ?? 0);
            $description = trim($_POST['description'] ?? '');

            if ($note < 1 || $note > 5 || empty($description)) {
                $_SESSION['error'] = 'Veuillez donner une note entre 1 et 5 et un commentaire.';
            } else {
                $avisTable = App::getInstance()->getTable('avis');
                $avisTable->creer($_SESSION['utilisateur_id'], $note, $description);
                $_SESSION['success'] = 'Merci pour votre avis !';
            }
            header('Location: index.php?p=commandes');
            exit;
        }

        $pageTitle = 'Laisser un avis';
        require __DIR__ . '/../../../../View/pages/user/avis.php';
    }
}
