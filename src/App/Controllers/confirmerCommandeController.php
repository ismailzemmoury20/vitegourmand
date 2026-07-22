<?php
namespace App\Controllers\user;

use App\App;

class confirmerCommandeController
{
    public function index(): void
    {
        $menu_id = (int) ($_GET['menu_id'] ?? 0);

        if (!isset($_SESSION['utilisateur_id'])) {
            header('Location: ?p=login&redirect=confirmer-commande&menu_id=' . $menu_id);
            exit;
        }

        $app = App::getInstance();
        $menuTable = $app->getTable('menu');
        $commandeTable = $app->getTable('commande');

        $menu = $menuTable->find($menu_id);

        if (!$menu) {
            header('Location: ?p=menus');
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $date_prestation = $_POST['date_prestation'] ?? '';
            $heure_livraison = $_POST['heure_livraison'] ?? '';
            $nombre_personnes = (int) ($_POST['nombre_personnes'] ?? 0);

            if (empty($date_prestation) || empty($heure_livraison) || $nombre_personnes <= 0) {
                $error = 'Merci de remplir tous les champs.';
            } elseif ($nombre_personnes < $menu->nombre_personne_minimum) {
                $error = 'Le nombre de personnes minimum pour ce menu est de ' . $menu->nombre_personne_minimum . '.';
            } elseif (strtotime($date_prestation) < strtotime('+5 days')) {
                $error = 'La commande doit être passée au moins 5 jours avant la prestation.';
            } else {

                $prix_menu = $menu->prix_par_personne * $nombre_personnes;
                $prix_livraison = 15.00;

                $numero_commande = 'CMD-' . date('Y') . '-' . strtoupper(substr(uniqid(), -6));

                $commandeTable->creer(
                    $date_prestation,
                    $heure_livraison,
                    $numero_commande,
                    $_SESSION['utilisateur_id'],
                    $menu_id,
                    $prix_menu,
                    $nombre_personnes,
                    $prix_livraison
                );

                header('Location: ?p=commandes');
                exit;
            }
        }

        require __DIR__ . '/../../view/pages/confirmer-commande.php';
    }
}