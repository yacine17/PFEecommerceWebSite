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
$per = new \app\classes\Personne('2', 'Arib', 'Farid', 'Paris', 'Farid@yahoo.com', '055652147');

$personneTable->create($per);
//var_dump($per);
