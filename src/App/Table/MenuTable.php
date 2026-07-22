<?php
namespace App\Table;

class MenuTable extends Table
{
    public function findAll(): array
    {
        return $this->query('SELECT * FROM menu ORDER BY menu_id DESC');
    }

    public function find(int $id): mixed
    {
        return $this->query('SELECT * FROM menu WHERE menu_id = ?', [$id], true);
    }

    public function statsCommandes(): array
    {
        $collection = \App\MongoDatabase::getInstance()->getCollection('commandes_par_menu');
        $documents = $collection->find();

        $resultats = [];
        foreach ($documents as $doc) {
            $resultats[] = [
                'titre'          => $doc['titre'],
                'total_commande' => $doc['nb_commandes'],
            ];
        }

        return $resultats;
    }

    public function creer(string $titre, string $description, int $nombrePersonneMin, float $prixParPersonne, int $quantiteRestante, string $conditions): int
    {
        $this->query(
            'INSERT INTO menu (titre, description, nombre_personne_minimum, prix_par_personne, quantite_restante, conditions) VALUES (?, ?, ?, ?, ?, ?)',
            [$titre, $description, $nombrePersonneMin, $prixParPersonne, $quantiteRestante, $conditions]
        );
        return (int) $this->getPDO()->lastInsertId();
    }

    public function ajouterPhoto(int $menuId, string $photoBinaire): void
    {
        $sql = 'INSERT INTO menu_photos (menu_id, photo) VALUES (?, ?)';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(1, $menuId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $photoBinaire, \PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function findPhotos(int $menuId): array
    {
        return $this->query('SELECT * FROM menu_photos WHERE menu_id = ?', [$menuId]);
    }

    public function findThemes(int $menuId): array
    {
        return $this->query(
            'SELECT theme.libelle FROM theme
             JOIN propose_theme ON theme.theme_id = propose_theme.theme_id
             WHERE propose_theme.menu_id = ?',
            [$menuId]
        );
    }

    public function findRegimes(int $menuId): array
    {
        return $this->query(
            'SELECT regime.libelle FROM regime
             JOIN adapte ON regime.regime_id = adapte.regime_id
             WHERE adapte.menu_id = ?',
            [$menuId]
        );
    }

    public function findPlats(int $menuId): array
    {
        return $this->query(
            'SELECT plat.titre_plat FROM plat
             JOIN propose ON plat.plat_id = propose.plat_id
             WHERE propose.menu_id = ?',
            [$menuId]
        );
    }

    public function associerTheme(int $menuId, int $themeId): void
    {
        $this->query('INSERT INTO propose_theme (menu_id, theme_id) VALUES (?, ?)', [$menuId, $themeId]);
    }

    public function associerRegime(int $menuId, int $regimeId): void
    {
        $this->query('INSERT INTO adapte (menu_id, regime_id) VALUES (?, ?)', [$menuId, $regimeId]);
    }

    public function associerPlat(int $menuId, int $platId): void
    {
        $this->query('INSERT INTO propose (menu_id, plat_id) VALUES (?, ?)', [$menuId, $platId]);
    }

    public function supprimer(int $id): void
    {
        $this->query('DELETE FROM menu WHERE menu_id = ?', [$id]);
    }

    public function modifier(int $id, string $titre, float $prix, int $stock): void
    {
        $this->query(
            'UPDATE menu SET titre = ?, prix_par_personne = ?, quantite_restante = ? WHERE menu_id = ?',
            [$titre, $prix, $stock, $id]
    );
    }

    public function compterCommandesAssociees(int $menu_id): int
    {
        $result = $this->query('SELECT COUNT(*) AS total FROM commande WHERE menu_id = ?', [$menu_id], true);
        return (int) ($result['total'] ?? 0);
    }
    public function filtrer(?float $prixMax, ?float $prixFourchette, ?string $regime, ?string $theme, ?int $personnesMin): array
    {
        $sql = 'SELECT DISTINCT menu.* FROM menu
                LEFT JOIN adapte ON menu.menu_id = adapte.menu_id
                LEFT JOIN regime ON adapte.regime_id = regime.regime_id
                LEFT JOIN propose_theme ON menu.menu_id = propose_theme.menu_id
                LEFT JOIN theme ON propose_theme.theme_id = theme.theme_id
                WHERE 1 = 1';
        $params = [];

        if ($prixMax !== null) {
            $sql .= ' AND menu.prix_par_personne <= ?';
            $params[] = $prixMax;
        }
        if ($prixFourchette !== null) {
            $sql .= ' AND menu.prix_par_personne <= ?';
            $params[] = $prixFourchette;
        }
        if ($regime !== null) {
            $sql .= ' AND regime.libelle = ?';
            $params[] = $regime;
        }
        if ($theme !== null) {
            $sql .= ' AND theme.libelle = ?';
            $params[] = $theme;
        }
        if ($personnesMin !== null) {
            $sql .= ' AND menu.nombre_personne_minimum >= ?';
            $params[] = $personnesMin;
        }

        return $this->query($sql, $params);
}
}
