<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 04/05/2017
 * Time: 18:01
 */
use app\classes\Commande;

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']) && !empty($_GET['id']))
    {
        require '..\..\app\Autoloader.php';
        app\Autoloader::register();
        $idCommande = $_GET['id'];
        $db = \app\Config::getInstance()->getDatabase();
        $commandeDb = new \app\table\CommandeTable($db);
        $commande = $commandeDb->findById($idCommande);
        ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="enteteModalCommande">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="text-center"><?php
                        if ($commande->getEtatValidation() == Commande::EN_COURS_DE_TRAITEMNT)
                            echo "La commande est en cours de traitement";
                        elseif ($commande->getEtatValidation() == Commande::APPROUVEE)
                            echo "La commande est validée";
                        elseif ($commande->getEtatValidation() == Commande::REFUSEE)
                            echo "La commande est refusée";
                        ?></h4>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <th colspan="2"> Produit</th>
                            <th>Quantité</th>
                            <th>Prix Total</th>
                        </tr>
                    <?php
                    foreach ($commande->getProduitCommandes() as $produitCommande)
                    {
                        /**
                         * @var $produitCommande \app\classes\ProduitCommande
                         */
                        ?>
                        <tr>
                            <td><img src="../images/<?= $produitCommande->getProduit()->getCheminPhoto()?>"
                                     width="75" height="75"></td>
                            <td><?= $produitCommande->getProduit()->getLibelle() ?></td>
                            <td><?= $produitCommande->getQuantite() ?></td>
                            <td><?= $produitCommande->getProduit()->getPrix() * $produitCommande->getQuantite() ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <?php
                        if ($commande->getEtatValidation() == Commande::APPROUVEE)
                        {
                            echo "<button type='button' class='btn btn-primary'>
                                  <i class='fa fa-print'></i>
                                    Bon de livraison</button>";
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
