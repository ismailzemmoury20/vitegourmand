<?php
namespace App\Table;

class RegimeTable extends Table
{
    public function findAll(): array
    {
        return $this->query('SELECT * FROM regime ORDER BY libelle');
    }
}
