<?php
namespace App\Controllers\Employe;

use App\App;
use App\Middleware\AuthMiddleware;

class menusController
{
    public function index(): void
    {
        AuthMiddleware::checkEmploye();
        $menuTable = App::getInstance()->getTable('menu');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if ($action === 'modifier' && !empty($_POST['menu_id'])) {
                $menu_id = (int) $_POST['menu_id'];
                $titre   = trim($_POST['titre'] ?? '');
                $prix    = (float) ($_POST['prix'] ?? 0);
                $stock   = (int) ($_POST['stock'] ?? 0);

                if (empty($titre) || $prix <= 0) {
                    $_SESSION['error'] = 'Veuillez remplir correctement tous les champs.';
                } else {
                    $menuTable->modifier($menu_id, $titre, $prix, $stock);
                }
                header('Location: index.php?p=employe-menus');
                exit;
            }

            if ($action === 'supprimer' && !empty($_POST['menu_id'])) {
                $menu_id = (int) $_POST['menu_id'];

                if ($menuTable->compterCommandesAssociees($menu_id) > 0) {
                    $_SESSION['error'] = 'Impossible : des commandes sont associées à ce menu.';
                } else {
                    $menuTable->supprimer($menu_id);
                }
                header('Location: index.php?p=employe-menus');
                exit;
            }
        }

        $error     = $_SESSION['error'] ?? '';
        unset($_SESSION['error']);
        $menus     = $menuTable->findAll();
        $pageTitle = 'Menus';
        require __DIR__ . '/../../../../View/pages/employe/menus.php';
    }
}