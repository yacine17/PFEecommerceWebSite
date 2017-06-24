<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 16/04/2017
 * Time: 21:40
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
\app\App::getInstance()->active = 'categorie';
$db = \app\Config::getInstance()->getDatabase();
if (isset($_GET['idCat']) && ctype_digit($_GET['idCat']))
{
    $idCat = $_GET['idCat'];
    $catDb = new \app\table\CategorieTable($db);
    $produitDb = new \app\table\ProduitTable($db);
    $marques = $produitDb->getAllMarques();
    if ($cat = $catDb->findById($idCat))
        $produits = $produitDb->getByCategorie($idCat);
    else
        $produits = $produitDb->getList();
    \app\App::getInstance()->title = $cat->getNom();
}
require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/modifierProfil.php';
require '../pages/templates/navbar.php';

?>
    <!--Start Filter-->
    <div class="filter">
        <div class="container">
            <p class="chemin"><strong>Catégorie: </strong>
                <a href="categorie.php?idCat=<?= $cat->getIdCategorie() ?>"><?= $cat->getNom() ?></a>
            </p>
            <form role="form" method="post" action="index.php?do=search">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="prixMin">Prix min</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="prixMin" placeholder="Prix min"
                                       min="0" name="prixMin" value="<?php if (isset($prixMin)) echo $prixMin ?>">
                                <div class="input-group-addon">.00 DA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="prixMax">Prix max</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="prixMax" placeholder="Prix max"
                                       min="0" name="prixMax" value="<?php if (isset($prixMax)) echo $prixMax ?>">
                                <div class="input-group-addon">.00 DA</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="marque">Marque</label>
                            <select class="form-control" id="marque" name="marque">
                                <option disabled selected value>Marque</option>
                                <option value="">Tous</option>
                                <?php
                                foreach ($marques as $mrq)
                                {
                                    $selctd = '';
                                    if (isset($marque) && $marque == $mrq->marque)
                                        $selctd = 'selected';
                                    if ($mrq->marque != '')
                                        echo "<option value='" . $mrq->marque . "' ". $selctd .">" . $mrq->marque . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="searchBar">Recherche</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchBar" placeholder="Search for..." name="search">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End Filter-->
    <!--Start Home-->
    <div class="home">
        <div class="container">
            <div class="row">
                <!--Start Products Home-->
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
                            <img src="../images/<?= $produit->getCheminPhoto() ?>" alt="<?= $produit->getLibelle() ?>">
                        </a>
                        <div>
                            <p><?php
                                if (strlen($produit->getLibelle()) < 20)
                                    echo $produit->getLibelle();
                                else
                                    echo substr($produit->getLibelle(), 0, 20)  . "...";
                                ?>
                            </p>
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
            <!--End Products Home-->
            <nav aria-label="..." >
                <div class="text-center">
                    <ul class="pagination">
                        <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                        <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">2 </a></li>
                        <li><a href="#">3 </a></li>
                        <li><a href="#">4 </a></li>
                        <li><a href="#">5 </a></li>
                        <li><a href="#">6 </a></li>
                        <li><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                    </ul>
                </div>
            </nav>
            <div class="modal fade" id="detailProduitModal" tabindex="-1" role="dialog" aria-labelledby="detailProduitModalLabel">
            </div>
        </div>
    </div>
    <!--End Home-->
<?php
require '../pages/templates/detailProduit.php';
require '../pages/templates/footer.php';