<?php
namespace App\Controllers;

use App\App;

class menusController
{
    public function index(): void
    {
        $app     = App::getInstance();
        $menus   = $app->getTable('menu')->findAll();
        $regimes = $app->getTable('regime')->findAll();
        $themes  = $app->getTable('theme')->findAll();
        require __DIR__ . '/../../../View/pages/menus.php';
    }

    public function filtrer(): void
    {
        $menuTable = App::getInstance()->getTable('menu');

        $prixMax    = !empty($_GET['prix_max']) ? (float) $_GET['prix_max'] : null;
        $prixFourchette = !empty($_GET['prix_fourchette']) ? (float) $_GET['prix_fourchette'] : null;
        $regime     = !empty($_GET['regime']) ? $_GET['regime'] : null;
        $theme      = !empty($_GET['theme']) ? $_GET['theme'] : null;
        $personnesMin = !empty($_GET['personnes_min']) ? (int) $_GET['personnes_min'] : null;

        $menus = $menuTable->filtrer($prixMax, $prixFourchette, $regime, $theme, $personnesMin);

        require __DIR__ . '/../../../View/partials/menus-liste.php';
        exit;
    }

    public function getMenuDetails(): void
    {
        $app = App::getInstance();
        $menuTable = $app->getTable('menu');
        $menu_id = (int) ($_GET['id'] ?? 0);

        $menu = $menuTable->find($menu_id);

        header('Content-Type: application/json');

        if (!$menu) {
            http_response_code(404);
            echo json_encode(['erreur' => 'Menu introuvable.']);
            exit;
        }

        $photos = $menuTable->findPhotos($menu_id);
        $photosEncodees = array_map(function ($photo) {
            return base64_encode($photo['photo']);
        }, $photos);

        if (empty($photosEncodees) && !empty($menu['photo'])) {
            $photosEncodees[] = base64_encode($menu['photo']);
        }

        $themes  = array_column($menuTable->findThemes($menu_id), 'libelle');
        $regimes = array_column($menuTable->findRegimes($menu_id), 'libelle');
        $plats   = array_column($menuTable->findPlats($menu_id), 'titre_plat');

        echo json_encode([
            'menu_id'                 => (int) $menu['menu_id'],
            'titre'                   => $menu['titre'],
            'description'             => $menu['description'],
            'conditions'              => $menu['conditions'],
            'nombre_personne_minimum' => (int) $menu['nombre_personne_minimum'],
            'prix_par_personne'       => (float) $menu['prix_par_personne'],
            'quantite_restante'       => (int) $menu['quantite_restante'],
            'photos'                  => $photosEncodees,
            'themes'                  => $themes,
            'regimes'                 => $regimes,
            'plats'                   => $plats,
        ]);
        exit;
    }
}