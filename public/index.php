<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

require_once __DIR__ . '/../routes/routes.php';

$page = $_GET['p'] ?? 'home';

if (!isset($routes[$page])) {
    http_response_code(404);
    die('Page introuvable.');
}

$controller = new $routes[$page]();

$action = $_GET['action'] ?? 'index';

if (!method_exists($controller, $action)) {
    $action = 'index';
}

$controller->$action();
