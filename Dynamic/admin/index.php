<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 02/04/2017
 * Time: 19:51
 */
<<<<<<< HEAD
require '..\app\Autoloader.php';
app\Autoloader::register();
require 'pages/templates/header.php';
require 'pages/templates/navbar.php';
require 'pages/InsererProduit.php';
=======
use app\classes\Authentification;
>>>>>>> 184f2d7bb5e4cd39fc9249cbd7ded80ab605d3fd

session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if ($_SERVER['REQUEST_METHOD'] == 'POST')//l'utilisateur vient d'une requete HTTP POST
{
    if (!empty($_POST['username']) && !empty($_POST['motDePasse']))
    {
        $_SESSION['auth'] = array(
            'username' => $_POST['username'],
            'motDePasse' => $_POST['motDePasse']
        );
    }
    else
    {
        //TODO Champs non remplis
    }
}
require 'pages/templates/header.php';
if (Authentification::estConnecte() && Authentification::estEmploye())
{

    require 'pages/templates/navbar.php';
    require 'pages/templates/footer.php';
}
else
{
    require 'pages/login.php';
}
