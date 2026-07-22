<?php
namespace App\Table;

class AvisTable extends Table
{
    public function findAll(): array
    {
        return $this->query(
            'SELECT avis.*, utilisateur.nom
             FROM avis
             JOIN utilisateur ON avis.utilisateur_id = utilisateur.utilisateur_id
             ORDER BY avis.avis_id DESC'
        );
    }

    public function supprimer(int $id): void
    {
        $this->query('DELETE FROM avis WHERE avis_id = ?', [$id]);
    }

    public function creer(int $utilisateur_id, int $note, string $description): void
    {
    $this->query(
        'INSERT INTO avis (note, description, statut, utilisateur_id) VALUES (?, ?, ?, ?)',
        [$note, $description, 'en attente', $utilisateur_id]
        );
    }
    
    public function valider(int $id): void
    {
        $this->query('UPDATE avis SET statut = ? WHERE avis_id = ?', ['validé', $id]);
    }

    public function refuser(int $id): void
    {
        $this->query('UPDATE avis SET statut = ? WHERE avis_id = ?', ['refusé', $id]);
    }

    public function findValides(): array
    {
        return $this->query(
            'SELECT avis.*, utilisateur.nom
                FROM avis
                JOIN utilisateur ON avis.utilisateur_id = utilisateur.utilisateur_id
                WHERE avis.statut = ?
                ORDER BY avis.avis_id DESC',
            ['validé']
        );
    }
}
