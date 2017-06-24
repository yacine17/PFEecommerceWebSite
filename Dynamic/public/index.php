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
if (isset($_GET['do'])) {
    $do = $_GET['do'];
} else {
    $do = 'home';
}
ob_start();
if ($do == 'home') {
    require '../pages/accueil.php';
} elseif ($do == 'search'){
    require '../pages/rechercheProduits.php';
}
$content = ob_get_clean();
require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/modifierProfil.php';
require '../pages/templates/navbar.php';
echo $content;
require '../pages/templates/footer.php';