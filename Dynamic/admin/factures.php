<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 06/04/2017
 * Time: 15:31
 */
use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estEmploye())
{
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';

    require 'pages/gestionFacture.php';

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}