<?php
namespace App\Controllers\User;

use App\App;
use App\Middleware\AuthMiddleware;

class commandesController
{
    public function index(): void
    {
        AuthMiddleware::checkClient();
        $success = $_SESSION['success'] ?? '';
        unset($_SESSION['success']);

        $commandeTable      = App::getInstance()->getTable('commande');
        $toutesLesCommandes = $commandeTable->findParUtilisateur($_SESSION['utilisateur_id']);

        $parPage    = 5;
        $totalPages = max(1, (int) ceil(count($toutesLesCommandes) / $parPage));
        $page       = (int) ($_GET['page'] ?? 1);

        if ($page < 1) {
            $page = 1;
        }
        if ($page > $totalPages) {
            $page = $totalPages;
        }

        $commandes = array_slice($toutesLesCommandes, ($page - 1) * $parPage, $parPage);
        $pageTitle = 'Mes commandes';
        require __DIR__ . '/../../../../View/pages/user/commandes.php';
    }

    public function annuler(): void
    {
        AuthMiddleware::check();
        $numero_commande = $_GET['numero'] ?? '';
        $commandeTable = App::getInstance()->getTable('commande');
        $commande = $commandeTable->find($numero_commande);

        if (!$commande || $commande['utilisateur_id'] != $_SESSION['utilisateur_id']) {
            die('Accès non autorisé.');
        }
        if ($commande['statut'] !== 'en attente') {
            die('Cette commande ne peut plus être annulée.');
        }

        $commandeTable->annuler($numero_commande);
        header('Location: /vitegourmand/public/index.php?p=commandes');
        exit;
    }

    public function modifier(string $numero_commande): void
    {
        AuthMiddleware::check();
        $commandeTable = App::getInstance()->getTable('commande');
        $commande = $commandeTable->find($numero_commande);

        if (!$commande || $commande['utilisateur_id'] != $_SESSION['utilisateur_id']) {
            die('Accès non autorisé.');
        }

        if ($commande['statut'] !== 'en attente') {
            $error = 'Cette commande ne peut plus être modifiée.';
            require __DIR__ . '/../../../../View/pages/user/modifier_commande.php';
            return;
        }

        $date_prestation = trim($_POST['date_prestation'] ?? '');
        $heure_livraison = trim($_POST['heure_livraison'] ?? '');
        $nombre_personne = (int) ($_POST['nombre_personne'] ?? 0);
        $code_postale    = trim($_POST['code_postale'] ?? '');
        $ville           = strtolower(trim($_POST['ville'] ?? ''));
        $distance_km     = (float) ($_POST['distance'] ?? 0);

        if (empty($date_prestation) || empty($heure_livraison) || $nombre_personne <= 0) {
            die('Veuillez remplir tous les champs correctement.');
        }

        $menuTable = App::getInstance()->getTable('menu');
        $menu = $menuTable->find($commande['menu_id']);
        $nombre_minimum = (int) $menu['nombre_personne_minimum'];
        $prix_unitaire  = (float) $menu['prix_par_personne'];

        if ($nombre_personne < $nombre_minimum) {
            die("Minimum {$nombre_minimum} personnes requis.");
        }

        $prix_base = $nombre_personne * $prix_unitaire;
        $reduction = ($nombre_personne >= $nombre_minimum + 5) ? $prix_base * 0.1 : 0;
        $prix_menu = $prix_base - $reduction;

        if (substr($code_postale, 0, 2) === '33' && str_contains($ville, 'bordeaux')) {
            $prix_livraison = 0;
        } elseif ($distance_km <= 0) {
            die('Distance requise pour livraison hors Bordeaux.');
        } else {
            $prix_livraison = 5 + ($distance_km * 0.59);
        }

        $commandeTable->modifier($numero_commande, $date_prestation, $heure_livraison, $nombre_personne, $prix_menu, $prix_livraison);
        header('Location: /vitegourmand/public/index.php?p=commandes');
        exit;
    }
}