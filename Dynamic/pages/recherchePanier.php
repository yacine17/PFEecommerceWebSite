<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 11/05/2017
 * Time: 21:39
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['do']) && $_POST['do'] == 'ajouterProduit' && isset($_POST['id']))
    {

    }
    if (isset($_POST['search'])) {
        require '..\app\Autoloader.php';
        app\Autoloader::register();
        \app\App::getInstance()->active = 'categorie';
        $prodDb = new \app\table\ProduitTable(\app\Config::getInstance()->getDatabase());
        $search = $_POST['search'];

        if (!empty($search)) {
            $produits = $prodDb->searchBar($search);
            $nbrproduit = 1;
            foreach ($produits as $produit) {
                /**
                 * @var $produit \app\classes\Produit
                 */
                echo "<li title='Ajouter au panier' data-id='" . $produit->getIdProduit() . "' class='ajouterPanier'>" . $produit->getLibelle() . "</li>";
                if (($nbrproduit++) == 3)
                    break;
            }
        }
    }
}