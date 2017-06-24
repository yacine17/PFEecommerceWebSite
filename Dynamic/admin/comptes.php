<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 20/05/2017
 * Time: 20:02
 */
use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estAdmin())
{
    \app\App::getInstance()->title = 'Gestion des factures';
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';

    require 'pages/gestionComptes.php';

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}