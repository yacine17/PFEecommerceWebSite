<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 16/04/2017
 * Time: 13:47
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
\app\App::getInstance()->active = 'favoris';
require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/navbar.php';
$db = \app\Config::getInstance()->getDatabase();
$produitDb = new \app\table\ProduitTable($db);
?>
<div class="contenu-panier">
    <div class="container">
        <?php
        if (!empty($_SESSION['favoris']))
        {?>
        <h1 class="text-center">VOS PRODUITS FAVORIS</h1>
        <div class="tab">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th colspan="2">PRODUIT</th>
                    <th>Prix</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php
                $cpt = 1;
                foreach ($_SESSION['favoris'] as $id) {
                    $produit = $produitDb->findbyId($id);
                    ?>
                    <tr>
                    <td> <?= $cpt++ ?></td >
                    <td><img src = "../images/<?= $produit->getCheminPhoto() ?>"/></td >
                    <td><h4><?= $produit->getLibelle() ?></h4></td>
                    <td > <?= $produit->getPrix() ?>.00 DA</td >
                    <td >
                        <a class="cart-add btn btn-warning"
                           href="../pages/gestionPanier.php?id=<?= $produit->getReferenceProduit() ?>">
                            <i class="fa fa-cart-plus" ></i >
                            Ajouter au panier
                        </a >
                    </td >
                        <td ><a class="supprimerFavori" href="../pages/gestionFavoris.php?do=supprimer&id=<?= $produit->getReferenceProduit() ?>">
                                <i class="fa fa-heart fa-2x article-favori" ></i >
                            </a>
                        </td >
                </tr >
                    <?php
                    }
                }
                else
                    echo "<div class='alert alert-danger'>Votre liste des favoris est vide</div>";
                ?>
            </table>
        </div>
    </div>
</div>
<?php
require '../pages/templates/footer.php';