<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 04/04/2017
 * Time: 18:38
 */
$db = \app\Config::getInstance()->getDatabase();
$comDb = new \app\table\CommandeTable($db);
$lastCommandes = $comDb->getLastCommandes(5);
$facDb = new \app\table\FactureTable($db);

?>
<div class="accueil">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="informations plusVendu">
                    <?php
                     $produitDb = new \app\table\ProduitTable($db);
                     $plusVendus = $produitDb->plusVendus(5);

                    ?>
                    <h4>Les produits les plus vendus</h4>
                    <p>De 04/03/2017 à 04/04/2017</p>
                    <table class="table">
                        <tr>
                            <th>Produit</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité vendue</th>
                            <th>Prix Total</th>
                        </tr>
                        <?php
                        foreach ($plusVendus as $plusVendu)
                        {
                            /**
                             * @var $plusVendu \app\classes\Produit
                             */
                            ?>
                            <tr>
                                <td><?= $plusVendu->getLibelle() ?></td>
                                <td><?= $plusVendu->getPrix() ?></td>
                                <td><?= $plusVendu->getNombreDeVente() ?></td>
                                <td><?= ($plusVendu->getPrix() * $plusVendu->getNombreDeVente()) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="informations derniereCommande">
                    <h4>Les dernieres commandes</h4>
                    <p>&nbsp;</p>
                    <table class="table">
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Prix Total</th>
                            <th>Etat</th>
                        </tr>
                        <?php
                        foreach ($lastCommandes as $commande)
                        {
                            /**
                             * @var $commande \app\classes\Commande
                             */
                            ?>
                            <tr>
                                <td><?= $commande->getNumCommande() ?></td>
                                <td><?= $commande->getClient()->getNom() . " " .
                                    $commande->getClient()->getPrenom() ?></td>
                                <td><?= date('d/m/Y', strtotime($commande->getDateCommande()))?></td>
                                <td><?= $commande->PrixTTC() ?>.00 DA</td>
                                <td>
                                    <?php
                                    if ($commande->getEtatValidation() == \app\classes\Commande::APPROUVEE)
                                    {
                                        echo "Validée";
                                    }
                                    elseif ($commande->getEtatValidation() == \app\classes\Commande::EN_COURS_DE_TRAITEMNT)
                                    {
                                        echo "En cours de traitement";
                                    }
                                    elseif ($commande->getEtatValidation() == \app\classes\Commande::REFUSEE)
                                    {
                                        echo "Refusée";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="informations employeActif">
                    <?php
                    $facDb = new \app\table\FactureTable($db);
                    $bestEmployes = $facDb->bestEmployes();
                    ?>
                    <h4>Les employés les plus actifs</h4>
                    <table class="table">
                        <tr>
                            <th>L'employé</th>
                            <th>Commandes validée</th>
                        </tr>
                        <?php
                        foreach ($bestEmployes as $bestEmploye)
                        {
                            ?>
                            <tr>
                                <td><?= $bestEmploye->employe->getNom() . " " . $bestEmploye->employe->getPrenom()?></td>
                                <td><?= $bestEmploye->nombreDeCommandes ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="col-md-3">
                <?php
                $revenu = $facDb->revenuMensuel();
                ?>
                <div class="informations revenuMensuel text-center">
                        <h3>Total de revenu mensuel</h3>
                        <p>De <?= date('d/m/Y', strtotime("-1 month"))?> à <?= date('d/m/y')?></p>
                        <h1><?= $revenu ?>.00 DA</h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="informations clientActif">
                    <h4>Les clients les plus actifs</h4>
                    <table class="table">
                        <tr>
                            <th>Client</th>
                            <th>Nombre de commande</th>
                            <th>Derniere commande</th>
                            <th>Total d'achats</th>
                        </tr>
                        <tr>
                            <td>Yacine</td>
                            <td>6</td>
                            <td>04/04/2017</td>
                            <td>85000.00 DA</td>
                        </tr>
                        <tr>
                            <td>Yacine</td>
                            <td>6</td>
                            <td>04/04/2017</td>
                            <td>85000.00 DA</td>
                        </tr>
                        <tr>
                            <td>Yacine</td>
                            <td>6</td>
                            <td>04/04/2017</td>
                            <td>85000.00 DA</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>