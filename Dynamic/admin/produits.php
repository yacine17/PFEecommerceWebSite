<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 06/04/2017
 * Time: 15:35
 */
use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estEmploye())
{
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';
    $do = !isset($_GET['do']) ? 'home' : $_GET['do'];
    if ($do == 'ajout')
    {
        require 'pages/modifierProduit.php';
    }
    elseif ($do == 'mod')
    {
        require 'pages/modifierProduit.php';
    }
    elseif ($do == 'valider')
    {
        require 'pages/modifierProduit.php';
    }
    else
    {
        require 'pages/gestionProduit.php';
    }

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}