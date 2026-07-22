<?php
namespace App\Table;

use App\App;
use PDO;
use PDOException;

class Table
{
    protected string $table;

    public function __construct()
    {
        $parts = explode('\\', get_class($this));
        $className = end($parts);
        $this->table = strtolower(str_replace('Table', '', $className));
    }

    protected function getPDO(): \PDO
    {
        return App::getInstance()->getDb()->getPDO();
    }

    public function find(int $id): mixed
    {
        return $this->query("SELECT * FROM {$this->table} WHERE {$this->table}_id = ?", [$id], true);
    }

    public function findAll(): array
    {
        return $this->query("SELECT * FROM {$this->table}");
    }

    protected function query(string $sql, array $params = [], bool $one = false): mixed
    {
        if (empty($params)) {
            $req = $this->getPDO()->query($sql);
        } else {
            $req = $this->getPDO()->prepare($sql);
            $req->execute($params);
        }

        if ($one) {
            return $req->fetch() ?: null;
        }
        return $req->fetchAll();
    }
}
