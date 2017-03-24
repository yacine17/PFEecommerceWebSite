<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 00:46
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
$personneTable = new \app\table\PersonneTable(\app\Config::getInstance()->getDatabase());
//$per = new \app\classes\Personne('1', 'HamzaCherif', 'Yacine', 'Tlemcen', 'yassinehm17@gmail.com', '0797870208');


$compteTable = new \app\table\CompteTable(\app\Config::getInstance()->getDatabase());
