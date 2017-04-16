<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 15/04/2017
 * Time: 22:06
 */
require '..\app\Autoloader.php';
app\Autoloader::register();


require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/navbar.php';
$db = \app\Config::getInstance()->getDatabase();
$produitDb = new \app\table\ProduitTable($db);
$prix = 0;
?>
    <div class="contenu-panier">
        <div class="container">
            <h1 class="text-center">VOTRE PANIER</h1>
            <div class="tab">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th colspan="2">PRODUIT</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th></th>
                        <th>Prix Total</th>
                        <th></th>
                    </tr>
                    <?php
                        foreach ($_SESSION['panier'] as $element)
                        {
                            $id = $element['id'];
                            $qte = $element['qte'];
                            $produit = $produitDb->findById($id);
                            $prix += $produit->getPrix() * $qte;
                            /**
                             * @var $produit \app\classes\Produit
                             */
                            ?>
                            <tr>
                                <td>1</td>
                                <td><img src="../images/<?= $produit->getCheminPhoto() ?>"/></td>
                                <td><h4><?= $produit->getLibelle() ?></h4></td>
                                <td><?= $produit->getPrix() ?>.00 DA</td>
                                <td><input type="number" min="0" value="<?= $qte ?>" class="form-control"><a><i class="fa fa-refresh"></i></a></td>
                                <td><?= $produit->getPrix() * $qte ?>.00 DA</td>
                                <td><button class="btn btn-danger retirer-produit"><i class="fa fa-trash"></i> Retirer</button></td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
            <div class="row">
                <div class=" col-md-4">
                    <div class="form-group">
                        <label class="input-group" for="ajouterArticle"><i class="fa fa-tag"></i> Ajouter un article au panier</label>
                        <input type="text" id="ajouterArticle" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4 lead">
                    <p>Total produit : <?= $prix ?>.00 DA</p>
                    <p>Total frais de port : 0 DA</p>
                    <p class="lead">Total : <strong><?= $prix?>.00 DA</strong></p>
                    <button class="btn btn-warning">Passer la commande</button>
                    <button class="btn btn-danger retirer-produit">Vider le panier</button>
                </div>
            </div>
        </div>
    </div>

<?php
require '../pages/templates/footer.php';