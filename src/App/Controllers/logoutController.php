<?php
namespace App\Controllers;

class logoutController
{
    public function index(): void
    {
        if (empty($_SESSION['utilisateur_id'])) {
            header('Location: /index.php?p=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION = [];
            session_destroy();
            header('Location: /index.php?p=login');
            exit;
        }

        require __DIR__ . '/../../../View/pages/logout.php';
    }
}
