<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 28/04/2017
 * Time: 21:03
 */
use app\classes\Commande;

session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
\app\App::getInstance()->active = '';
if (\app\classes\Authentification::estConnecte())
{
    require '../pages/templates/header.php';
    require '../pages/templates/login.php';
    require '../pages/templates/modifierProfil.php';
    require '../pages/templates/navbar.php';

    $db = \app\Config::getInstance()->getDatabase();
    $commandeDb = new \app\table\CommandeTable($db);
    $commandes = $commandeDb->getByPersonne($_SESSION['user']);
    if ($commandes) {
        ?>
        <div class="mesCommandes">
            <div class="container">
                <h1 class="text-center">Mes commandes</h1>
                <table class="table">
                    <tr>
                        <th>N° de commande</th>
                        <th>Valeur de la commande</th>
                        <th>Date de la commande</th>
                        <th>Statut de la commande</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($commandes as $commande)
                    {
                    /**
                     * @var $commande Commande
                     */
                        ?>
                        <tr data-toggle="modal" data-target="#detailCommandeModal" data-id="<?= $commande->getNumCommande() ?>">
                            <td><?= $i++ ?></td>
                            <td><?= $commande->PrixTTC() ?>.00 DA</td>
                            <td><?= $commande->getDateCommande() ?></td>
                            <td>
                            <?php
                                if ($commande->getEtatValidation() == Commande::EN_COURS_DE_TRAITEMNT)
                                    echo "<span class='text-warning'>En cours de traitement</span>";
                                elseif ($commande->getEtatValidation() == Commande::APPROUVEE)
                                    echo "<span class='text-success'>Validée</span>";
                                elseif ($commande->getEtatValidation() == Commande::REFUSEE)
                                    echo "<span class='text-danger'>Refusée</span>";
                            ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <!--<tr data-toggle="modal" data-target="#myModal">
                        <td>1</td>
                        <td>21000.00 DA</td>
                        <td>28/04/2017</td>
                        <td>Livrée</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>21000.00 DA</td>
                        <td>28/04/2017</td>
                        <td>Livrée</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>21000.00 DA</td>
                        <td>28/04/2017</td>
                        <td>Livrée</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>21000.00 DA</td>
                        <td>28/04/2017</td>
                        <td>Livrée</td>
                    </tr>-->
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="detailCommandeModal" tabindex="-1" role="dialog" aria-labelledby="detailCommandeModalLabel">

        </div>
        <?php
    }//fin if commandes
    else

        echo '<br><br><div class="alert alert-danger">Votre liste est vide.</div>';
    require '../pages/templates/footer.php';
}//fin if estConnecte
else
{
    //header('location: index.php');
}
