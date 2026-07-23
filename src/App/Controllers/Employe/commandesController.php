<?php
namespace App\Controllers\Employe;

use App\App;
use App\Middleware\AuthMiddleware;
use App\Mail\Mailer;

class commandesController
{
    private array $transitionsSimples = [
        'en attente'     => 'en préparation',
        'en préparation' => 'prête',
        'prête'          => 'livrée',
    ];

    private function calculerStatutSuivant(array $commande): ?string
    {
        $statut = $commande['statut'] ?? '';

        if ($statut === 'livrée') {
            return (int) ($commande['pret_materiel'] ?? 0) === 1
                ? 'en attente du retour de matériel'
                : 'terminée';
        }

        if ($statut === 'en attente du retour de matériel') {
            return 'terminée';
        }

        return $this->transitionsSimples[$statut] ?? null;
    }

    public function index(): void
    {
        AuthMiddleware::checkEmploye();
        $commandeTable = App::getInstance()->getTable('commande');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            $estAdmin = (int) ($_SESSION['role_id'] ?? 0) === 1;

            if ($action === 'modifier_statut' && !empty($_POST['numero_commande']) && !empty($_POST['statut'])) {
                $commande = $commandeTable->find($_POST['numero_commande']);
                $nouveauStatut = $_POST['statut'];
                $statutSuivant = $commande ? $this->calculerStatutSuivant($commande) : null;
                $statutsLibres = ['en attente', 'en préparation', 'prête', 'livrée'];
                $statutsSpeciaux = ['en attente du retour de matériel', 'terminée'];

                $autorise = false;

                if ($commande && in_array($nouveauStatut, $statutsSpeciaux, true)) {
                    $autorise = $nouveauStatut === $statutSuivant;
                } elseif ($commande && $estAdmin && in_array($nouveauStatut, $statutsLibres, true) && $nouveauStatut !== $commande['statut']) {
                    $autorise = true;
                } elseif ($commande && !$estAdmin && $nouveauStatut === $statutSuivant) {
                    $autorise = true;
                }

                if ($autorise) {
                    $ancienStatut = $commande['statut'];
                    $commandeTable->modifierStatut($_POST['numero_commande'], $nouveauStatut);

                    if ($nouveauStatut === 'en attente du retour de matériel') {
                        Mailer::envoyer(
                            $commande['email_client'],
                            'Restitution du matériel de location - Vite & Gourmand',
                            "Bonjour {$commande['prenom_client']},\n\nVotre commande {$commande['numero_commande']} a été livrée. Le matériel mis à disposition doit nous être restitué dans un délai de 10 jours ouvrés à compter de la livraison.\n\nConformément à nos conditions générales de vente (CGV), des frais de 600 € seront appliqués en cas de non-restitution du matériel dans ce délai.\n\nPour organiser la restitution, merci de bien vouloir reprendre contact directement avec notre équipe.\n\nCordialement,\nVite & Gourmand"
                        );
                    }

                    if ($nouveauStatut === 'terminée' && $ancienStatut === 'en attente du retour de matériel') {
                        $commandeTable->marquerMaterielRestitue($_POST['numero_commande']);
                    }
                } else {
                    $_SESSION['error'] = 'Ce changement de statut n\'est pas autorisé : le statut doit avancer d\'une seule étape.';
                }
                header('Location: index.php?p=employe-commandes');
                exit;
            }

            if ($action === 'annuler' && !empty($_POST['numero_commande'])) {
                $mode_contact = trim($_POST['mode_contact'] ?? '');
                $motif        = trim($_POST['motif'] ?? '');
                $commande     = $commandeTable->find($_POST['numero_commande']);
                $statutsBloques = $estAdmin ? ['annulée'] : ['livrée', 'annulée'];

                if (empty($mode_contact) || empty($motif)) {
                    $_SESSION['error'] = 'Veuillez indiquer le mode de contact et le motif d\'annulation.';
                } elseif (!$commande || in_array($commande['statut'], $statutsBloques, true)) {
                    $_SESSION['error'] = 'Cette commande ne peut plus être annulée.';
                } else {
                    $commandeTable->annuler($_POST['numero_commande'], $mode_contact, $motif);
                }
                header('Location: index.php?p=employe-commandes');
                exit;
            }
        }

        $error  = $_SESSION['error'] ?? '';
        unset($_SESSION['error']);

        $search = $_GET['commande'] ?? '';
        $statut = $_GET['statut']   ?? '';
        $tri    = $_GET['tri']      ?? 'date';
        $sens   = $_GET['sens']     ?? 'desc';

        $toutesLesCommandes = $commandeTable->rechercher($search, $statut);

        usort($toutesLesCommandes, function ($a, $b) use ($tri, $sens) {
            if ($tri === 'total') {
                $valeurA = (float) $a['prix_menu'] + (float) $a['prix_livraison'];
                $valeurB = (float) $b['prix_menu'] + (float) $b['prix_livraison'];
            } else {
                $valeurA = strtotime($a['date_commande']);
                $valeurB = strtotime($b['date_commande']);
            }
            return $sens === 'asc' ? $valeurA <=> $valeurB : $valeurB <=> $valeurA;
        });

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

        foreach ($commandes as &$commande) {
            $commande['statut_suivant'] = $this->calculerStatutSuivant($commande);
        }
        unset($commande);

        $pageTitle = 'Commandes';
        require __DIR__ . '/../../../../View/pages/employe/commandes.php';
    }

    public function detail(): void
    {
        AuthMiddleware::checkEmploye();
        $numero = $_GET['numero'] ?? '';

        if (!$numero) {
            header('Location: index.php?p=employe-commandes');
            exit;
        }

        $commandeTable = App::getInstance()->getTable('commande');
        $commande = $commandeTable->find($numero);

        if (!$commande) {
            header('Location: index.php?p=employe-commandes');
            exit;
        }

        $commande['statut_suivant'] = $this->calculerStatutSuivant($commande);

        $historique = $commandeTable->findHistorique($numero);
        $pageTitle  = 'Détail de la commande';
        require __DIR__ . '/../../../../View/pages/employe/commande-detail.php';
    }
}
