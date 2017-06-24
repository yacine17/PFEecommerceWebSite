<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 03/04/2017
 * Time: 18:24
 */
use app\classes\CommandeFournisseur;
use app\classes\Produit;

use app\table\ProduitTable;
$db = \app\Config::getInstance()->getDatabase();
$produitDb = new ProduitTable($db);
$produits = $produitDb->getList();
$catDb = new \app\table\CategorieTable($db);
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{

}
if ($produits) {
    ?>
    <div class="gestionProduit">
        <div class="container">
            <h1 class="text-center">Gestion des produits</h1>
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher un produit" id="rechercherProduit">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
                </div>
            </form>
            <table class="table tablesorter" id="tableDesProduit">
                <thead>
                <tr>
                    <th>Reference</th>
                    <th colspan="2">Produit</th>
                    <th>Categorie</th>
                    <th>Prix</th>
                    <th>Etat de vente</th>
                    <th>Réduction </th>
                    <th>Qte dispo</th>
                    <th>Qte vendue</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($produits as $produit) {
                    /* @var $produit Produit */
                    $etatVente = ($produit->getEtatVente() == Produit::SANS_PROMOTION) ? 'Sans promotion' : 'En promotion';
                    $reduction = ($produit->getEtatVente() == Produit::SANS_PROMOTION) ? $produit->getPourcentageReduction() : '';
                    ?>
                    <tr>
                        <td><?= $produit->getReferenceProduit() ?></td>
                        <td><img src="../images/<?= $produit->getCheminPhoto() ?>" width="50" height="30"></td>
                        <td><?= $produit->getLibelle() ?></td>
                        <td><?= $catDb->findById($produit->getIdCategorie())->getNom() ?></td>
                        <td><?= $produit->getPrix() ?>.00 DA</td>
                        <td><?= $etatVente ?></td>
                        <td><?= $reduction ?></td>
                        <td><?= $produit->getStock()->getQuantiteDisponible() ?></td>
                        <td><?= $produit->getNombreDeVente() ?></td>
                        <td>
                            <i class="fa fa-ellipsis-v"></i>
                            <div class="menu">
                                <ul class="list-unstyled">
                                    <li>
                                        <a class="btn btn-block btn-success" href="?do=mod&id=<?= $produit->getIdProduit() ?>">
                                            <i class="fa fa-edit"></i> Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-block btn-danger confirm supprimerProduit" href="?do=supprimer&id=<?= $produit->getIdProduit() ?>">
                                            <i class="fa fa-close"></i> Supprimer
                                        </a>
                                    </li>
                                    <li><button type="button" class="btn btn-block btn-primary commander" data-toggle="modal"
                                                data-target="#CommanderModal" data-id="<?= $produit->getIdProduit() ?>">
                                            <i class="fa fa-list"></i> Commander
                                        </button></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <!--Start Ajouter nouveau produit-->
            <div class="ajouterNouveauProduit bg-primary text-center" title="Ajouter nouveau produit"
                 onclick="window.location='?do=ajout'">
                <i class="fa fa-tag"></i><sup><i class="fa fa-plus"></i></sup>
            </div>
            <!--End Ajouter nouveau produit-->
            <!--Start Modal -->
            <div class="modal fade" id="CommanderModal" tabindex="-1" role="dialog" aria-labelledby="CommanderModalLabel">

            </div>
            <!--End Modal-->
        </div>
    </div>
    <?php
}
else
{
    echo "<br><br><br><div class='gestionProduit'><div class='container'><div class='alert alert-danger'>La liste des produits est vide.</div>
            <div class=\"ajouterNouveauProduit bg-primary text-center\" title=\"Ajouter nouveau produit\"
                 onclick=\"window.location='?do=ajout'\"><i class=\"fa fa-tag\"></i><sup><i class=\"fa fa-plus\"></i></sup>
            </div></div></div> ";
}