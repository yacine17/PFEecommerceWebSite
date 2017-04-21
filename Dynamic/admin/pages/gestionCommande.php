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
                                <button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#detailCommande\">Préparer
                                </button>
                            </td>
                        </tr>";

            }
            ?>
               <!-- <tr>
                    <td>15472</td>
                    <td>Yacine</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3543</td>
                    <td>Hichem</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>9874</td>
                    <td>Farid</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>4213</td>
                    <td>Amine</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>9874</td>
                    <td>Younes</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2354</td>
                    <td>Adil</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>3652</td>
                    <td>Mohammed</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>2144</td>
                    <td>Youcef</td>
                    <td>03/04/2017</td>
                    <td>Validé</td>
                    <td>Tlemcen</td>
                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#detailCommande">
                            Préparer
                        </button>
                    </td>
                </tr>-->
            </tbody>
        </table>
        <!--Start Modal-->
        <div class="modal fade" id="detailCommande" tabindex="-1" role="dialog">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="text-center">Détails Commande n° 15</h2>
                    </div>
                    <div class="modal-body">
                        <table class="table text-center">
                            <tr>
                                <th>Produit</th>
                                <th>Quantité commandée</th>
                                <th>Quantité restante</th>
                                <th>Disponibilité</th>
                            </tr>
                            <tr>
                                <td>Prdouit azesq</td>
                                <td>15</td>
                                <td>100</td>
                                <td>Disponible</td>
                            </tr>
                            <tr>
                                <td>Prdouit azesq</td>
                                <td>15</td>
                                <td>100</td>
                                <td>Disponible</td>
                            </tr>
                            <tr>
                                <td>Prdouit azesq</td>
                                <td>15</td>
                                <td>100</td>
                                <td>Disponible</td>
                            </tr>
                            <tr>
                                <td>Prdouit azesq</td>
                                <td>15</td>
                                <td>100</td>
                                <td>Disponible</td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Reporter</button>
                        <button type="button" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal-->
    </div>
</div>
