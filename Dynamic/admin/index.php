<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 02/04/2017
 * Time: 19:51
 */
//use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();

require 'pages/templates/header.php';
//if (Authentification::estConnecte() && Authentification::estEmploye())
{
    require 'pages/templates/navbar.php';
    require 'pages/templates/footer.php';
}
/*else
{
    require 'pages/login.php';
}
*/