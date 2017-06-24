<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 03/04/2017
 * Time: 19:00
 */
$db = \app\Config::getInstance()->getDatabase();
$commandeDb = new \app\table\CommandeTable($db);
$commandes = $commandeDb->getAll();
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['do']) && isset($_GET['id']) && !empty($_GET['do']) && !empty($_GET['id']))
    {
        if ($_GET['do'] == 'valider')
        {
            $commandeValidee = $commandeDb->findById($_GET['id']);
            if ($commandeValidee)
            {
                $p = new \app\table\ProduitCommandeTable($db);
                $produitsCommandes = $p->findByNumCommande($_GET['id']);
                $stockDb = new \app\table\StockTable($db);
                foreach ($produitsCommandes as $produitsCommande)
                {
                    /**
                     * @var $produitsCommande \app\classes\ProduitCommande
                     */
                    $stock = $stockDb->findById($produitsCommande->getIdProduit());
                    //mise a jour de stock
                    $qte = $stock->getQuantiteDisponible() - $produitsCommande->getQuantite();
                    $stock->setQuantiteDisponible($qte);
                    $stockDb->update($stock);
                    $produitsCommande->getProduit()->setNombreDeVente(($produitsCommande->getProduit()->getNombreDeVente() + $produitsCommande->getQuantite() ));
                    $prodDb = new \app\table\ProduitTable($db);
                    $prodDb->update($produitsCommande->getProduit());
                }
                //établir la facture
                $facture = new \app\classes\Facture(null, $commandeValidee->getNumCommande(), null, 0, null,
                    date("Y-m-d"), \app\classes\Facture::NON_REGLEE, \app\classes\Facture::NON_LIVREE,
                    $_SESSION['auth']['id']);
                $facture->setCommande($commandeValidee);
                $facture->calculerPrixTTC();
                $factureDb = new \app\table\FactureTable($db);
                $factureDb->create($facture);
                $commandeValidee->setEtatValidation(\app\classes\Commande::APPROUVEE);
                $commandeDb->update($commandeValidee);

            }
        }
    }
}
if ($commandes) {
    ?>
    <div class="gestionCommande">
        <div class="container">
            <h1 class="text-center">Gestion des commandes</h1>
            <form>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher une commande"
                           id="rechercherCommande">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
                </div>
            </form>
            <table class="table tablesorter" id="tableDesCommandes">
                <thead>
                <tr>
                    <th>N° commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Etat</th>
                    <th>Adresse livraison</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($commandes as $commande) {
                    /**
                     * @var $commande \app\classes\Commande
                     */
                    $personneDb = new \app\table\PersonneTable($db);
                    $personne = $personneDb->findByID($commande->getId());
                    $etat = '';
                    if ($commande->getEtatValidation() == \app\classes\Commande::EN_COURS_DE_TRAITEMNT)
                        $etat = 'En attente  de validation';
                    elseif ($commande->getEtatValidation() == \app\classes\Commande::APPROUVEE)
                        $etat = 'Approuvée';
                    elseif ($commande->getEtatValidation() == \app\classes\Commande::REFUSEE)
                        $etat = 'Refusée';

                    echo "<tr data-toggle='modal' data-target='#detailCommande'
                                    data-id='" . $commande->getNumCommande() . "' data-etat='" . $commande->getEtatValidation() . "'>
                            <td>" . $commande->getNumCommande() . "</td>
                            <td>" . $personne->getNom() . " " . $personne->getPrenom() . "</td>
                            <td>" . $commande->getDateCommande() . "</td>
                            <td>" . $etat . "</td>
                            <td>" . $commande->getAdresseLivraison() . "</td>
                        </tr>";
                }
                ?>
                </tbody>
            </table>
            <!--Start Modal-->
            <div class="modal fade" id="detailCommande" tabindex="-1" role="dialog">

            </div>
            <!--End Modal-->
        </div>
    </div>
    <?php
}
else
{
    echo "<br><br><br><div class='container'><div class='alert alert-danger'>La liste des commande est vide</div></div>";
}