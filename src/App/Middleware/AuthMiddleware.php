<?php
namespace App\Middleware;

class AuthMiddleware
{
    private const TIMEOUT = 1200;

    public static function check(): void
    {
        if (empty($_SESSION['utilisateur_id'])) {
            header('Location: /vitegourmand/public/index.php?p=login');
            exit;
        }

        if (!empty($_SESSION['derniere_activite']) && (time() - $_SESSION['derniere_activite']) > self::TIMEOUT) {
            session_unset();
            session_destroy();
            header('Location: /vitegourmand/public/index.php?p=login&timeout=1');
            exit;
        }

        $_SESSION['derniere_activite'] = time();

        if (!empty($_SESSION['doit_changer_mdp'])) {
            header('Location: /vitegourmand/public/index.php?p=changer-mdp');
            exit;
        }
    }

    public static function checkClient(): void
    {
        self::check();
        if (($_SESSION['role_id'] ?? null) != 2) {
            http_response_code(403);
            die('Accès non autorisé.');
        }
    }

    public static function checkEmploye(): void
    {
        self::check();
        if (!in_array((int) ($_SESSION['role_id'] ?? 0), [1, 3], true)) {
            http_response_code(403);
            die('Accès non autorisé.');
        }
    }

    public static function checkAdmin(): void
    {
        self::check();
        if (($_SESSION['role_id'] ?? null) != 1) {
            http_response_code(403);
            die('Accès non autorisé.');
        }
    }
}
