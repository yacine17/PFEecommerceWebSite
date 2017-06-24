<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 29/04/2017
 * Time: 17:47
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['search']))
    {
        $prodDb = new \app\table\ProduitTable(\app\Config::getInstance()->getDatabase());
        $search = $_POST['search'];
        $prixMin = (isset($_POST['prixMin'])) ? filter_var($_POST['prixMin'], FILTER_SANITIZE_NUMBER_INT) : null;
        $prixMax = (isset($_POST['prixMax'])) ? filter_var($_POST['prixMax'], FILTER_SANITIZE_NUMBER_INT) : null;
        $marque = (isset($_POST['marque'])) ? filter_var($_POST['marque'], FILTER_SANITIZE_STRING) : null;

        $produits = $prodDb->searchBar($search, $prixMin, $prixMax, $marque);
        $marques = $prodDb->getAllMarques();
            ?>
            <!--Start Filter-->
            <div class="filter">
                <div class="container">
                    <p class="chemin">Recherche pour <strong><?= $search ?></strong></p>
                    <form role="form" method="post" action="?do=search">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="prixMin">Prix min</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="prixMin" placeholder="Prix min"
                                               min="0" name="prixMin" value="<?php if (isset($prixMin)) echo $prixMin ?>">
                                        <div class="input-group-addon">.00 DA</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                                            echo "<option value='" . $mrq->marque . "' ". $selctd .">" . $mrq->marque . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sousCategorie">Categorie</label>
                                    <select class="form-control" id="sousCategorie">
                                        <option disabled selected value>Categorie</option>
                                        <option>Pc Bureau</option>
                                        <option>Laptop</option>
                                        <option>Téléphone</option>
                                        <option>Accesoires</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="searchBar">Recherche</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="searchBar" placeholder="Search for..."
                                               name="search" value="<?php if (isset($search)) echo $search?>">
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
            <div class="home">
                <div class="container">
                <?php
                if ($produits)
                {
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
                    <!-- Modal -->
                    <div class="modal fade" id="detailProduitModal" tabindex="-1" role="dialog" aria-labelledby="detailProduitModalLabel">
                    </div>
                </div>
            </div>
        <?php
        } //Fin if($produits)
        else
        {
            //TODO pas de prosuits corosepent a ces filtres
        }
    }

}