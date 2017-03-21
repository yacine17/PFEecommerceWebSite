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
} elseif ($do == 'cat'){
    require '../pages/categorie.php';
}
$content = ob_get_clean();
require '../pages/templates/header.php';
require '../pages/templates/footer.php';