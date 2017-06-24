<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 06/04/2017
 * Time: 15:36
 */
use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estAdmin())
{
    \app\App::getInstance()->title = 'Gestion des commandes fournisseurs';
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';

    require 'pages/gestionCommandeFournisseur.php';

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}