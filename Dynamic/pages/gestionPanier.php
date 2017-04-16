<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 15/04/2017
 * Time: 22:01
 */
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (\app\classes\Authentification::estConnecte())
{
    if (isset($_GET['id']) && ctype_digit($_GET['id']))
    {
        if (!is_array($_SESSION['panier']))
            $_SESSION['panier'] = array();
        $exist = false;
        foreach ($_SESSION['panier'] as $produit)
        {
            if ($produit['id'] == $_GET['id'])
                $exist = true;
        }
        if (!$exist)
        {
            $element = array(
                'id' => $_GET['id'],
                'qte' => 1
            );
            array_push($_SESSION['panier'], $element);
        }
    }
    else
    {
        if (!is_array($_SESSION['panierNonConnecte']))
            $_SESSION['panierNonConnecte'] = array();
        array_push($_SESSION['panierNonConnecte'], $_GET['id']);
    }
    //header('location: ../index.php');
}