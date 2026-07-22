<?php

$routes = [

    'home'                => \App\Controllers\homeController::class,
    'menus'               => \App\Controllers\menusController::class,
    'menus-filtrer'       => \App\Controllers\menusController::class,
    'login'               => \App\Controllers\loginController::class,
    'register'            => \App\Controllers\registerController::class,
    'logout'              => \App\Controllers\logoutController::class,
    'contact'             => \App\Controllers\contactController::class,
    'forgot-password'     => \App\Controllers\forgotPasswordController::class,
    'reset-password'      => \App\Controllers\resetPasswordController::class,
    'changer-mdp'         => \App\Controllers\changerMdpController::class,

    'commande'            => \App\Controllers\User\commandeController::class,
    'commandes'           => \App\Controllers\User\commandesController::class,
    'mes-informations'    => \App\Controllers\User\mesInformationsController::class,
    'suivi-commande'      => \App\Controllers\User\suiviCommandeController::class,
    'avis'                => \App\Controllers\User\avisClientController::class,

    'employe-commandes'   => \App\Controllers\Employe\commandesController::class,
    'employe-menus'       => \App\Controllers\Employe\menusController::class,
    'employe-plats'       => \App\Controllers\Employe\platsController::class,
    'employe-horaires'    => \App\Controllers\Employe\horairesController::class,
    'employe-avis-clients'=> \App\Controllers\Employe\avisClientsController::class,

    'admin-employes'      => \App\Controllers\Admin\employesController::class,
    'admin-admins'        => \App\Controllers\Admin\adminsController::class,
    'admin-clients'       => \App\Controllers\Admin\clientsController::class,
    'admin-dashboard'     => \App\Controllers\Admin\dashboardController::class,
    'admin-plats'         => \App\Controllers\Admin\platsController::class,
    'admin-menus'         => \App\Controllers\Admin\menusController::class,
    'admin-horaires'      => \App\Controllers\Admin\horairesController::class,
    'admin-commandes'     => \App\Controllers\Admin\commandesController::class,
    'admin-avis-clients'  => \App\Controllers\Admin\avisClientsController::class,

];