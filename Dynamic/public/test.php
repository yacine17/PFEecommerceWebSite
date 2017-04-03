<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 00:46
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
//$personneTable = new \app\table\PersonneTable(\app\Config::getInstance()->getDatabase());
//$per = new \app\classes\Personne('1', 'HamzaCherif', 'Yacine', 'Tlemcen', 'yassinehm17@gmail.com', '0797870208');
//$compteTable = new \app\table\CompteTable(\app\Config::getInstance()->getDatabase());
//$employeTable = new \app\table\EmployeTable(\app\Config::getInstance()->getDatabase());
//$emp = new \app\classes\Employe('yayayayy', 'hahahaha', '13', '0', '55', 'non-active', null, 45, 21);
//$employeTable->delete($emp);
//$r = $employeTable->getAll();
//$produit1 = new \app\classes\Produit(1, 2, 'Galaxy S7', '70000.00', 'azeaz', 'ezae', '20');
//$produit2 = new \app\classes\Produit(2, 1, 'Iphone S6', 120000.00, 'zz', 'aaa');

//$prTable = new \app\table\ProduitTable(\app\Config::getInstance()->getDatabase());
//$prTable->create($produit1);

//$car1 = new \app\classes\Caracteristique(1, 2, 'Ram', '2GB');
//$car2 = new \app\classes\Caracteristique(2, 2, 'Ecran', '5.6 pouces');
//$car3 = new \app\classes\Caracteristique(3, 1, 'Ram', '3GB');
//$car4 = new \app\classes\Caracteristique(4, 1, 'Ecran', '5 pouces');

//$carTable = new \app\table\CaracteristiqueTable(\app\Config::getInstance()->getDatabase());
//$carTable->create($car3);

//$commande1 = new \app\classes\Commande(4, 1, date('Y-m-d'), 'Alger', \app\classes\Commande::EN_COURS_DE_TRAITEMNT);
//$commande2 = new \app\classes\Commande(3, 2, date('Y-m-d'), 'Oran', \app\classes\Commande::APPROUVEE);

//$comTable = new \app\table\CommandeTable(\app\Config::getInstance()->getDatabase());
//$r = $comTable->findById($commande2);

//$p = new \app\classes\ProduitCommande(1, 2, 20);
//$p1 = new \app\classes\ProduitCommande(2, 2, 5);

//$pt = new \app\table\ProduitCommandeTable(\app\Config::getInstance()->getDatabase());
//$r = $pt->create($p);

//$s1 = new \app\classes\Stock(1, 2, \app\classes\Stock::DISPONIBLE, 20);
//$s2 = new \app\classes\Stock(2, 1, \app\classes\Stock::NON_DISPONIBLE, 0);

//$st = new \app\table\StockTable(\app\Config::getInstance()->getDatabase());
//var_dump($st->create($s1));

//$fa1 = new \app\classes\Facture(1, 1, 1500.00, 20, 1800.00, date('Y-m-d'), \app\classes\Facture::REGLEE, \app\classes\Facture::LIVREE, 3);
//$fa2 = new \app\classes\Facture(2, 2, 3300.00, 20, 3400.00, date('Y-m-d'), \app\classes\Facture::REGLEE, \app\classes\Facture::NON_LIVREE, 7);
//$fat = new \app\table\FactureTable(\app\Config::getInstance()->getDatabase());
//var_dump($fat->create($fa1));
/*
$res=\app\Config::getInstance()->getDatabase()->query("SELECT count(id) as nbrc FROM Personne WHERE id LIKE 'C%'");
var_dump($res[0]->nbrc);
echo $res[0]->nbrc  ;*/

