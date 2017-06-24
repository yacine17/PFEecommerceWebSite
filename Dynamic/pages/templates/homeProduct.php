<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:26
 */
session_start();
$db = \app\Config::getInstance()->getDatabase();
$produitDb = new \app\table\ProduitTable($db);
$produits = $produitDb->getList(12);
?>
<!--Start Home-->
<div class="home">
    <div class="container">
        <h1 class="text-center">NOS PRODUITS</h1>
        <p class="chemin">Produits à la une...</p>
        <div class="row">
            <?php
                foreach ($produits as $produit)
                {
                    /**
                     * @var $produit \app\classes\Produit
                     */
                    ?>
                    <div class="col-sm-6 col-md-3">
                        <div class="product">
                            <a data-toggle="modal" data-target="#detailProduitModal" data-id="<?= $produit->getIdProduit() ?>">
                                <img src="../images/<?= $produit->getCheminPhoto() ?>" alt="<?= $produit->getLibelle() ?>"
                                class="cloudzoom" data-cloudzoom="zoomImage: '../images/<?= $produit->getCheminPhoto() ?>'">
                            </a>
                            <div>
                                <p><?php
                                    if (strlen($produit->getLibelle()) < 20)
                                        echo $produit->getLibelle();
                                    else
                                        echo substr($produit->getLibelle(), 0, 20)  . "..."
                                    ?></p>
                                <h5 class="prix text-right"><?= $produit->getPrix() . " " ?>DA</h5>
                                <div class="buttons">
                                    <a class="cart-add" href="../pages/gestionPanier.php?id=<?= $produit->getIdProduit() ?>">
                                        <i class="fa fa-cart-plus"></i> Ajouter au panier</a><br>
                                    <a class="favori-add" href="../pages/gestionFavoris.php?id=<?= $produit->getIdProduit() ?>">
                                        <i class="fa fa-heart-o"></i> Ajouter au favoris</a><br>
                                    <a class="compare-add"><i class="fa fa-plus-square"></i> Ajouter au comparteur</a><br>
                                    <div>
                                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers
                                         .facebook.com%2Fdocs%2Fplugins%2F&width=220&layout=button&action=like&size=small&sho
                                          w_faces=false&share=true&height=65&appId"
                                                width="220" height="65" style="border:none;overflow:hidden"
                                                scrolling="no" frameborder="0" allowTransparency="true"
                                                class="text-center"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="detailProduitModal" tabindex="-1" role="dialog" aria-labelledby="detailProduitModalLabel">
        </div>
    </div>
</div>
<!--End Home-->
<?php
require '../pages/templates/detailProduit.php';