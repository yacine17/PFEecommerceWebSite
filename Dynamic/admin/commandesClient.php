<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 06/04/2017
 * Time: 14:45
 */
use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estEmploye())
{
    \app\App::getInstance()->title = 'Gestion des commandes clients';
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';

    require 'pages/gestionCommande.php';

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}