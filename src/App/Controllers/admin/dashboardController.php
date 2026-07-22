<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;

class dashboardController
{
    public function index(): void
    {
        AuthMiddleware::checkAdmin();
        $app           = App::getInstance();
        $commandeTable = $app->getTable('commande');
        $menuTable     = $app->getTable('menu');

        $commandes       = $menuTable->statsCommandes();
        $chiffre_affaire = $commandeTable->chiffreAffaires();
        $ca_actuel       = $commandeTable->caMoisActuel();
        $ca_precedent    = $commandeTable->caMoisPrecedent();

        $taux = ($ca_precedent > 0)
            ? (($ca_actuel - $ca_precedent) / $ca_precedent) * 100
            : 0;

        $labels = array_column($commandes, 'titre');
        $data   = array_column($commandes, 'total_commande');

        $menu_id_filtre = !empty($_GET['menu_id']) ? (int) $_GET['menu_id'] : null;
        $date_debut     = !empty($_GET['date_debut']) ? $_GET['date_debut'] : null;
        $date_fin       = !empty($_GET['date_fin']) ? $_GET['date_fin'] : null;

        $ca_par_menu = $commandeTable->chiffreAffairesParMenu($menu_id_filtre, $date_debut, $date_fin);

        $tousLesMenus = $menuTable->findAll();

        $pageTitle = 'Tableau de bord';
        require __DIR__ . '/../../../../View/pages/admin/dashboard.php';
    }
}