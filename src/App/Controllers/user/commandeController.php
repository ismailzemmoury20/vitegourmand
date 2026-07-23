<?php
namespace App\Controllers\User;

use App\App;
use App\Middleware\AuthMiddleware;

class commandeController
{
    public function index(): void
    {
        if (empty($_SESSION['utilisateur_id'])) {
            $menu_id = (int) ($_GET['menu_id'] ?? 0);
            header('Location: /index.php?p=login&redirect=commande&menu_id=' . $menu_id);
            exit;
        }
        AuthMiddleware::checkClient();
        $app           = App::getInstance();
        $menuTable     = $app->getTable('menu');
        $commandeTable = $app->getTable('commande');
        $menu       = null;
        $prix_total = 0;
        $error      = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menu_id = (int)($_POST['menu_id'] ?? 0);
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $numero_rue = trim($_POST['numero_rue'] ?? '');
            $rue = trim($_POST['rue'] ?? '');
            $complementaire = trim($_POST['complementaire'] ?? '');
            $code_postale = trim($_POST['code_postale'] ?? '');
            $ville = strtolower(trim($_POST['ville'] ?? ''));
            $date_prestation = trim($_POST['date'] ?? '');
            $heure_livraison = trim($_POST['livraison'] ?? '');
            $nombre_personnes = (int)   ($_POST['number'] ?? 0);
            $distance_km = (float) ($_POST['distance'] ?? 0);

            if (!$menu_id || !$nom || !$prenom) {
                $error = 'Données invalides.';
            } else {
                $menu = $menuTable->find($menu_id);
                if (!$menu) {
                    $error = 'Menu introuvable.';
                } else {
                    $nombre_minimum = (int) $menu['nombre_personne_minimum'];
                    $prix_unitaire  = (float) $menu['prix_par_personne'];

                    if ($nombre_personnes < $nombre_minimum) {
                        $error = "Minimum {$nombre_minimum} personnes requis.";
                    } else {
                        $prix_base = $nombre_personnes * $prix_unitaire;
                        $reduction = ($nombre_personnes >= $nombre_minimum + 5) ? $prix_base * 0.1 : 0;
                        $prix_apres_reduction = $prix_base - $reduction;

                        if (substr($code_postale, 0, 2) === '33' && str_contains($ville, 'bordeaux')) {
                            $frais_livraison = 0;
                        } elseif ($distance_km <= 0) {
                            $error = 'Distance requise pour livraison hors Bordeaux.';
                            $frais_livraison = 0;
                        } else {
                            $frais_livraison = 5 + ($distance_km * 0.59);
                        }

                        if (!$error) {
                            $prix_total = $prix_apres_reduction + $frais_livraison;

                            do {
                                $numero_commande = 'CMD-' . random_int(1000, 9999);
                            } while ($commandeTable->find($numero_commande));

                            $commandeTable->creer(
                                $date_prestation,
                                $heure_livraison,
                                $numero_commande,
                                $_SESSION['utilisateur_id'],
                                $menu_id,
                                $prix_apres_reduction,
                                $nombre_personnes,
                                $frais_livraison
                            );

                            $_SESSION['success'] = "Commande validée ! Numéro : $numero_commande | Total : " . number_format($prix_total, 2) . ' €';
                            header('Location: /index.php?p=commandes');
                            exit;
                        }
                    }
                }
            }
        }

        if (!$menu) {
            $menu_id = (int) ($_GET['menu_id'] ?? 0);
            if ($menu_id) {
                $menu = $menuTable->find($menu_id);
            }
        }

        require __DIR__ . '/../../../../View/pages/user/confirmer-commande.php';
    }
}