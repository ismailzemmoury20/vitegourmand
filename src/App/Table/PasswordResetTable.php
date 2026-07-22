<?php
namespace App\Table;

class PasswordResetTable extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'password_resets';
    }

    public function creerToken(int $user_id, string $token): void
    {
        $expires_at = date('Y-m-d H:i:s', time() + 3600);
        $this->query(
            'INSERT INTO password_resets (user_id, token, expires_at, used) VALUES (?, ?, ?, 0)',
            [$user_id, $token, $expires_at]
        );
    }

    public function findToken(string $token): mixed
    {
        return $this->query(
            'SELECT * FROM password_resets WHERE token = ? AND used = 0 AND expires_at > NOW()',
            [$token],
            true
        );
    }

    public function utiliserToken(int $id): void
    {
        $this->query('UPDATE password_resets SET used = 1 WHERE id = ?', [$id]);
    }
}
