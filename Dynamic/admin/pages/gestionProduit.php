<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 03/04/2017
 * Time: 18:24
 */
use app\classes\Produit;

use app\table\ProduitTable;
$db = \app\Config::getInstance()->getDatabase();
$produitDb = new ProduitTable($db);
$produits = $produitDb->getList();();
$catDb = new \app\table\CategorieTable($db);
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
        <table class="table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th colspan="2">Produit</th>
                    <th>Categorie</th>
                    <th>Prix</th>
                    <th>Etat de vente</th>
                    <th>Réduction</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($produits as $produit)
                {
                    /* @var $produit Produit */
                    $etatVente = ($produit->getEtatVente() == Produit::SANS_PROMOTION ) ? 'Sans promotion' : 'En promotion';
                    $reduction = ($produit->getEtatVente() == Produit::SANS_PROMOTION ) ? $produit->getPourcentageReduction() : '';
                    ?>
                    <tr>
                        <td><?= $produit->getReferenceProduit() ?></td>
                        <td><img src="../images/<?= $produit->getCheminPhoto() ?>" width="50" height="30"></td>
                        <td><?= $produit->getLibelle() ?></td>
                        <td><?= $catDb->findById($produit->getIdCategorie())->getNom() ?></td>
                        <td><?= $produit->getPrix()?>.00 DA</td>
                        <td><?= $etatVente ?></td>
                        <td><?= $reduction ?></td>
                        <td>
                            <a class="btn btn-success" href="?do=mod&id=<?= $produit->getReferenceProduit()?>">
                                <i class="fa fa-edit"></i> Modifier
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger confirm" href="?id=<?= $produit->getReferenceProduit()?>">
                                <i class="fa fa-close"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!--Start Ajouter nouveau produit-->
        <div class="ajouterNouveauProduit bg-primary text-center" title="Ajouter nouveau produit" onclick="window.location='?do=ajout'">
            <i class="fa fa-tag"></i><sup><i class="fa fa-plus"></i></sup>
        </div>
        <!--End Ajouter nouveau produit-->
    </div>
</div>
