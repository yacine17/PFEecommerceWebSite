<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 21/04/2017
 * Time: 22:30
 */

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['etat'])){
        require '../../../app/Autoloader.php';
        app\Autoloader::register();
        $idCommande = $_GET['id'];
        $etatCommande = $_GET['etat'];
        //Si la commande est validée ou refuser on desactive le bouton valider
        $etatCommande = ($etatCommande == \app\classes\Commande::EN_COURS_DE_TRAITEMNT) ? '' : 'disabled';
        $db = \app\Config::getInstance()->getDatabase();
        $produitCommandeDb = new \app\table\ProduitCommandeTable($db);
        $produitCommandes = $produitCommandeDb->findByNumCommande($idCommande);
        $produitDb = new \app\table\ProduitTable($db);
        $stockDb = new \app\table\StockTable($db);
        ?>
        <!--Start Modal-->
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="text-center">Détails Commande n° <?= $idCommande ?></h2>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center">
                            <tr>
                                <th>Produit</th>
                                <th>Quantité commandée</th>
                                <th>Quantité restante</th>
                            </tr>
                            <?php foreach ($produitCommandes as $produitCommande) {
                                /**
                                 * @var $produitCommande \app\classes\ProduitCommande
                                 * @var $produit \app\classes\Produit
                                 * @var $stock \app\classes\Stock
                                 */
                                $produit = $produitDb->findById($produitCommande->getIdProduit());
                                $stock = $stockDb->findById($produitCommande->getIdProduit());
                                $alert = "class='alert alert-success'";
                                if ($stock->getQuantiteDisponible() < $produitCommande->getQuantite())
                                    $alert = "class='alert alert-danger'";
                                ?>
                                <tr <?= $alert?>>
                                    <td><?= $produit->getLibelle() ?></td>
                                    <td><?= $produitCommande->getQuantite() ?></td>
                                    <td><?= $stock->getQuantiteDisponible() ?></td>
                                </tr>
                                <?php
                            }
                                ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Reporter</button>
                        <a  class="btn btn-primary" href="?do=valider&id=<?= $idCommande ?>" <?=$etatCommande?>>Valider</a>
                    </div>
                </div>
            </div>
        <!--End Modal-->
        <?php
    }
}