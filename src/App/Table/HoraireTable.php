<?php
namespace App\Table;

class HoraireTable extends Table
{
    public function findAll(): array
    {
        return $this->query('SELECT horaire_id, jour, heure_ouverture, heure_fermeture FROM horaire ORDER BY horaire_id');
    }

    public function modifier(int $id, string $ouverture, string $fermeture): void
    {
        $this->query(
            'UPDATE horaire SET heure_ouverture = ?, heure_fermeture = ? WHERE horaire_id = ?',
            [$ouverture, $fermeture, $id]
        );
    }
}
