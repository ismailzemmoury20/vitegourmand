<?php
namespace App\Table;

class CommandeTable extends Table
{
    public function findAll(): array
    {
        return $this->query(
            'SELECT commande.*, menu.titre AS titre_menu, utilisateur.nom AS nom_client
             FROM commande
             JOIN menu ON commande.menu_id = menu.menu_id
             JOIN utilisateur ON commande.utilisateur_id = utilisateur.utilisateur_id
             ORDER BY commande.date_commande DESC'
        );
    }

    public function rechercher(string $search = '', string $statut = ''): array
    {
        $sql = 'SELECT commande.*, menu.titre AS titre_menu, utilisateur.nom AS nom_client,
                       utilisateur.prenom AS prenom_client, utilisateur.email AS email_client
                FROM commande
                JOIN menu ON commande.menu_id = menu.menu_id
                JOIN utilisateur ON commande.utilisateur_id = utilisateur.utilisateur_id
                WHERE 1 = 1';
        $params = [];

        if (!empty($search)) {
            $sql .= ' AND utilisateur.nom LIKE ?';
            $params[] = "%$search%";
        }
        if (!empty($statut)) {
            $sql .= ' AND commande.statut = ?';
            $params[] = $statut;
        }
        $sql .= ' ORDER BY commande.date_commande DESC';

        return $this->query($sql, $params);
    }

    public function findParUtilisateur(int $utilisateur_id): array
    {
        return $this->query(
            'SELECT commande.*, menu.titre AS titre_menu
             FROM commande
             JOIN menu ON commande.menu_id = menu.menu_id
             WHERE commande.utilisateur_id = ?
             ORDER BY commande.date_commande DESC',
            [$utilisateur_id]
        );
    }

    public function findParNumero(string $numero, int $utilisateur_id): mixed
    {
        return $this->query(
            'SELECT commande.*, utilisateur.prenom, utilisateur.nom, utilisateur.email, menu.titre
             FROM commande
             JOIN utilisateur ON commande.utilisateur_id = utilisateur.utilisateur_id
             JOIN menu ON commande.menu_id = menu.menu_id
             WHERE commande.numero_commande = ? AND commande.utilisateur_id = ?',
            [$numero, $utilisateur_id],
            true
        );
    }

    public function chiffreAffaires(): float
    {
        $result = $this->query('SELECT SUM(prix_menu) AS total FROM commande', [], true);
        return (float) ($result['total'] ?? 0);
    }

    public function caMoisActuel(): float
    {
        $result = $this->query(
            'SELECT SUM(prix_menu) AS total FROM commande
             WHERE date_commande BETWEEN DATE_FORMAT(CURDATE(), "%Y-%m-01") AND LAST_DAY(CURDATE())',
            [],
            true
        );
        return (float) ($result['total'] ?? 0);
    }

    public function caMoisPrecedent(): float
    {
        $result = $this->query(
            'SELECT SUM(prix_menu) AS total FROM commande
             WHERE date_commande BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), "%Y-%m-01")
             AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))',
            [],
            true
        );
        return (float) ($result['total'] ?? 0);
    }

    public function marquerMaterielRestitue(string $numero_commande): void
    {
        $this->query('UPDATE commande SET restitution_materiel = 1 WHERE numero_commande = ?', [$numero_commande]);
    }

    public function modifierStatut(string $numero_commande, string $statut): void
    {
        $this->query('UPDATE commande SET statut = ? WHERE numero_commande = ?', [$statut, $numero_commande]);

        $this->query(
            'INSERT INTO historique_statut (numero_commande, statut) VALUES (?, ?)',
            [$numero_commande, $statut]
        );
    }

    public function findHistorique(string $numero_commande): array
    {
        return $this->query(
            'SELECT * FROM historique_statut WHERE numero_commande = ? ORDER BY date_modification ASC',
            [$numero_commande]
        );
    }

    public function annuler(string $numero_commande, ?string $mode_contact = null, ?string $motif = null): void
    {
        if ($mode_contact !== null && $motif !== null) {
            $this->query(
                'UPDATE commande SET statut = ?, mode_contact = ?, motif_annulation = ? WHERE numero_commande = ?',
                ['annulée', $mode_contact, $motif, $numero_commande]
            );
        } else {
            $this->query(
                'UPDATE commande SET statut = ? WHERE numero_commande = ?',
                ['annulée', $numero_commande]
            );
        }

        $this->query(
            'INSERT INTO historique_statut (numero_commande, statut) VALUES (?, ?)',
            [$numero_commande, 'annulée']
        );
    }

    public function creer(string $date_prestation, string $heure_livraison, string $numero_commande, int $utilisateur_id, int $menu_id, float $prix_menu, int $nombre_personne, float $prix_livraison): void
    {
        $this->query(
            'INSERT INTO commande (date_commande, date_prestation, heure_livraison, numero_commande, utilisateur_id, menu_id, prix_menu, nombre_personne, prix_livraison, statut)
            VALUES (CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?, "en attente")',
            [$date_prestation, $heure_livraison, $numero_commande, $utilisateur_id, $menu_id, $prix_menu, $nombre_personne, $prix_livraison]
        );

        $this->query(
            'INSERT INTO historique_statut (numero_commande, statut) VALUES (?, ?)',
            [$numero_commande, 'en attente']
        );
    }
    
    public function find($numero_commande, bool $one = true): mixed
    {
        return $this->query(
            'SELECT commande.*, menu.titre AS titre_menu, utilisateur.nom AS nom_client,
                    utilisateur.prenom AS prenom_client, utilisateur.email AS email_client,
                    utilisateur.telephone, utilisateur.numero_rue, utilisateur.rue,
                    utilisateur.adresse_postale, utilisateur.ville
                FROM commande
                JOIN menu ON commande.menu_id = menu.menu_id
                JOIN utilisateur ON commande.utilisateur_id = utilisateur.utilisateur_id
                WHERE commande.numero_commande = ?',
            [$numero_commande],
            $one
        );
    }
    public function chiffreAffairesParMenu(?int $menu_id = null, ?string $dateDebut = null, ?string $dateFin = null): array
    {
        $sql = 'SELECT menu.menu_id, menu.titre, SUM(commande.prix_menu) AS total_ca
                FROM commande
                JOIN menu ON commande.menu_id = menu.menu_id
                WHERE 1 = 1';
        $params = [];

        if ($menu_id !== null) {
            $sql .= ' AND menu.menu_id = ?';
            $params[] = $menu_id;
        }
        if ($dateDebut !== null && $dateFin !== null) {
            $sql .= ' AND commande.date_commande BETWEEN ? AND ?';
            $params[] = $dateDebut;
            $params[] = $dateFin;
        }

        $sql .= ' GROUP BY menu.menu_id, menu.titre';

        return $this->query($sql, $params);
    }
    
    public function modifier(string $numero_commande, string $date_prestation, string $heure_livraison, int $nombre_personne, float $prix_menu, float $prix_livraison): void
    {
        $this->query(
            'UPDATE commande SET date_prestation = ?, heure_livraison = ?, nombre_personne = ?, prix_menu = ?, prix_livraison = ? WHERE numero_commande = ?',
            [$date_prestation, $heure_livraison, $nombre_personne, $prix_menu, $prix_livraison, $numero_commande]
        );
    }
}
