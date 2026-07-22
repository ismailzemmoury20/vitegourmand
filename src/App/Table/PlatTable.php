<?php
namespace App\Table;

class PlatTable extends Table
{
    public function findAll(): array
    {
        return $this->query('SELECT plat_id, titre_plat, photo FROM plat');
    }

    public function creer(string $titre, string $photo): void
    {
        $sql = 'INSERT INTO plat (titre_plat, photo) VALUES (?, ?)';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(1, $titre, \PDO::PARAM_STR);
        $stmt->bindParam(2, $photo, \PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function modifier(int $id, string $titre, string $photo): void
    {
        $sql = 'UPDATE plat SET titre_plat = ?, photo = ? WHERE plat_id = ?';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(1, $titre, \PDO::PARAM_STR);
        $stmt->bindParam(2, $photo, \PDO::PARAM_LOB);
        $stmt->bindParam(3, $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function modifierTitre(int $id, string $titre): void
    {
        $this->query('UPDATE plat SET titre_plat = ? WHERE plat_id = ?', [$titre, $id]);
    }

    public function supprimer(int $id): void
    {
        $this->query('DELETE FROM contient WHERE plat_id = ?', [$id]);
        $this->query('DELETE FROM propose WHERE plat_id = ?', [$id]);
        $this->query('DELETE FROM plat WHERE plat_id = ?', [$id]);
    }
}
