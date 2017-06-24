<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 15/04/2017
 * Time: 22:06
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
\app\App::getInstance()->active = 'panier';

require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/modifierProfil.php';
require '../pages/templates/navbar.php';
$db = \app\Config::getInstance()->getDatabase();
$produitDb = new \app\table\ProduitTable($db);
$prix = 0;
if (\app\classes\Authentification::estConnecte())
    $lienPasserCommande = "data-target='#passerCommandeModal' data-toggle='modal'";
else
    $lienPasserCommande = "data-toggle='modal' data-target='#loginModal'";
?>
    <div class="contenu-panier">
        <div class="container">
            <?php if (!empty($_SESSION['panier']))
            {?>
            <h1 class="text-center">VOTRE PANIER</h1>
            <div class="detailPanier">
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
                    $cpt = 1;
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
                            <tr data-idProduit="<?= $id ?>">
                                <td><?= $cpt++ ?></td>
                                <td><img src="../images/<?= $produit->getCheminPhoto() ?>"/></td>
                                <td><h4><?= $produit->getLibelle() ?></h4></td>
                                <td><span class="prixUnitaire"><?= $produit->getPrix() ?></span>.00 DA</td>
                                <td><input type="number" min="1" value="<?= $qte ?>" class="form-control quantiteProduit"><a><i class="fa fa-refresh"></i></a></td>
                                <td><span class="montant"><?= $produit->getPrix() * $qte ?></span>.00 DA</td>
                                <td><a class="btn btn-danger retirer-produit"
                                       href="../pages/gestionPanier.php?do=supprimer&id=<?= $produit->getIdProduit() ?>">
                                        <i class="fa fa-trash"></i>
                                        Retirer
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                </table>
            </div>
            <div class="row">
                <div class=" col-md-4">
                    <div class="form-group">
                        <label class="input-group" for="ajouterArticle">
                            <i class="fa fa-tag"></i> Ajouter un article au panier
                        </label>
                        <input type="text" id="ajouterArticle" class="form-control">
                    </div>
                    <div class="resultatRecherche">
                        <ul class="list-unstyled">

                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4 lead">
                    <p>Total produit : <span class="prixTotalHorsTaxe"><?= $prix ?></span>.00 DA</p>
                    <p>Total frais de port : 0 DA</p>
                    <p class="lead">Total : <strong><span class="prixTTC"><?= $prix?></span>.00 DA</strong></p>
                    <button class="btn btn-warning" <?= $lienPasserCommande ?>>
                        Passer la commande
                    </button>
                    <a class="btn btn-danger retirerToutProduit" href="../pages/gestionPanier.php?do=supprimerTout">
                        Vider le panier
                    </a>
                </div>
            </div>
                <?php }
                else
                {
                    echo "<div class='alert alert-danger'>Votre panier est vide</div>";
                }
                ?>
            </div>
        </div>
    </div>
<?php
require '../pages/templates/passerCommande.php';
require '../pages/templates/footer.php';
?>