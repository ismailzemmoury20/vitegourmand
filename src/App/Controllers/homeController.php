<?php
namespace App\Controllers;

use App\App;

class homeController
{
    public function index(): void
    {
        $avisTable = App::getInstance()->getTable('avis');
        $avis      = $avisTable->findValides();

        $pageTitle = 'Accueil';

        require __DIR__ . '/../../../View/pages/home.php';
    }
}