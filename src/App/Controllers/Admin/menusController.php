<?php
namespace App\Controllers\Admin;

use App\App;
use App\Middleware\AuthMiddleware;

class menusController
{
    public function index(): void
    {
        AuthMiddleware::checkAdmin();
        $menuTable = App::getInstance()->getTable('menu');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'supprimer' && !empty($_POST['menu_id'])) {
                $menu_id = (int) $_POST['menu_id'];

                if ($menuTable->compterCommandesAssociees($menu_id) > 0) {
                    $_SESSION['error'] = 'Impossible : des commandes sont associées à ce menu.';
                } else {
                    $menuTable->supprimer($menu_id);
                }
                header('Location: index.php?p=admin-menus');
                exit;
            }

            if ($action === 'modifier' && !empty($_POST['menu_id'])) {
                $menu_id = (int) $_POST['menu_id'];
                $titre = trim($_POST['titre'] ?? '');
                $prix = (float) ($_POST['prix'] ?? 0);
                $stock = (int) ($_POST['stock'] ?? 0);

                if (empty($titre) || $prix <= 0) {
                    $_SESSION['error'] = 'Veuillez remplir correctement tous les champs.';
                } else {
                    $menuTable->modifier($menu_id, $titre, $prix, $stock);
                }
                header('Location: index.php?p=admin-menus');
                exit;
            }
        }

        $error = $_SESSION['error'] ?? '';
        $success = $_SESSION['success'] ?? '';
        unset($_SESSION['error'], $_SESSION['success']);

        $menus = $menuTable->findAll();
        $pageTitle = 'Gestion des menus';
        require __DIR__ . '/../../../../View/pages/admin/menus.php';
    }

    public function ajouter(): void
    {
        AuthMiddleware::checkAdmin();
        $app = App::getInstance();
        $menuTable = $app->getTable('menu');
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre  = trim($_POST['titre'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $conditions  = trim($_POST['conditions'] ?? '');
            $nombreMin = (int) ($_POST['nombre_personne_minimum'] ?? 0);
            $prix = (float) ($_POST['prix_par_personne'] ?? 0);
            $stock = (int) ($_POST['quantite_restante'] ?? 0);

            if (!$titre || !$description || $nombreMin <= 0 || $prix <= 0 || $stock < 0) {
                $error = 'Veuillez remplir correctement tous les champs obligatoires.';
            } else {
                $menu_id = $menuTable->creer($titre, $description, $nombreMin, $prix, $stock, $conditions);

                if (!empty($_FILES['photos']['name'][0])) {
                    $extensionsAutorisees = ['jpg', 'jpeg', 'png', 'webp'];

                    foreach ($_FILES['photos']['name'] as $index => $nomFichier) {
                        if (empty($nomFichier)) {
                            continue;
                        }

                        $extension = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION));

                        if (!in_array($extension, $extensionsAutorisees)) {
                            continue;
                        }
                        if ($_FILES['photos']['size'][$index] > 5 * 1024 * 1024) {
                            continue;
                        }

                        $photo = file_get_contents($_FILES['photos']['tmp_name'][$index]);
                        $menuTable->ajouterPhoto($menu_id, $photo);
                    }
                }

                foreach ($_POST['themes'] ?? [] as $themeId) {
                    $menuTable->associerTheme($menu_id, (int) $themeId);
                }
                foreach ($_POST['regimes'] ?? [] as $regimeId) {
                    $menuTable->associerRegime($menu_id, (int) $regimeId);
                }
                foreach ($_POST['plats'] ?? [] as $platId) {
                    $menuTable->associerPlat($menu_id, (int) $platId);
                }

                $_SESSION['success'] = 'Menu créé avec succès.';
                header('Location: index.php?p=admin-menus');
                exit;
            }
        }

        $plats     = $app->getTable('plat')->findAll();
        $themes    = $app->getTable('theme')->findAll();
        $regimes   = $app->getTable('regime')->findAll();
        $pageTitle = 'Ajouter un menu';
        require __DIR__ . '/../../../../View/pages/admin/menu-ajouter.php';
    }
}
