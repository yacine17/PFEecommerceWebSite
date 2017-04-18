<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 21/03/2017
 * Time: 15:02
 */
//Charger la classe Autoloader qui s'occupe de chager les autres classes
require '..\app\Autoloader.php';
app\Autoloader::register();

ob_start();

    \app\App::getInstance()->active = 'accueil';
    require '../pages/accueil.php';

$content = ob_get_clean();
require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/navbar.php';
echo $content;
require '../pages/templates/footer.php';