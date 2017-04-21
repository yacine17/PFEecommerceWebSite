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
?>
<div class="gestionCommande">
    <div class="container">
        <h1 class="text-center">Gestion des commandes</h1>
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher une commande" id="rechercherCommande">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>N° commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Etat</th>
                    <th>Adresse livraison</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($commandes as $commande)
            {
                /**
                 * @var $commande \app\classes\Commande
                 */
                $personneDb = new \app\table\PersonneTable($db);
                $personne = $personneDb->findByID($commande->getId());
                $etat = '';
                if ($commande->getEtatValidation() == \app\classes\Commande::EN_COURS_DE_TRAITEMNT)
                    $etat = 'En cours de traitement';
                elseif ($commande->getEtatValidation() == \app\classes\Commande::APPROUVEE)
                    $etat = 'Approuvée';
                elseif ($commande->getEtatValidation() == \app\classes\Commande::REFUSEE)
                    $etat = 'Refusée';

                echo "<tr>
                            <td>" . $commande->getNumCommande() . "</td>
                            <td>" . $personne->getNom() . " " . $personne->getPrenom() . "</td>
                            <td>" . $commande->getDateCommande() . "</td>
                            <td>" . $etat . "</td>
                            <td>" . $commande->getAdresseLivraison() . "</td>
                            <td>
                                <button type='button' class='btn btn-warning detailCommande' data-toggle='modal' data-target='#detailCommande'
                                    data-id='" . $commande->getNumCommande() . "'>
                                Préparer
                                </button>
                            </td>
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
