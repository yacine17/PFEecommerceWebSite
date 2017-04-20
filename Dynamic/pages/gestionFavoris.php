<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 16/04/2017
 * Time: 13:28
 */
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (isset($_GET['do']) && ($_GET['do'] == 'supprimer'))
{
    if (isset($_GET['id']) && in_array($_GET['id'], $_SESSION['favoris'])) {
        $i = array_search($_GET['id'], $_SESSION['favoris']);
        unset($_SESSION['favoris'][$i]);
    } else
        header('500 Internal Server Error', true, 500);
}
else
{
    if (isset($_GET['id']))
    {
        if (!is_array($_SESSION['favoris']))
            $_SESSION['favoris'] = array();
        if (!in_array($_GET['id'], $_SESSION['favoris']))
            array_push($_SESSION['favoris'], $_GET['id']);
        else
            header('500 Internal Server Error', true, 500);
    }
}

