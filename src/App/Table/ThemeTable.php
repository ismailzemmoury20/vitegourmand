<?php
namespace App\Table;

class ThemeTable extends Table
{
    public function findAll(): array
    {
        return $this->query('SELECT * FROM theme ORDER BY libelle');
    }
}
