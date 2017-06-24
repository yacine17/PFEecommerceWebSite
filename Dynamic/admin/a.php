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
if (Authentification::estConnecte() && Authentification::estEmploye())
{
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';
    $facDb = new \app\table\FactureTable(\app\Config::getInstance()->getDatabase());
    $fac = $facDb->bestEmployes();

    var_dump($fac);
    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}