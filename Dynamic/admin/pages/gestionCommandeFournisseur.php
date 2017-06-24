<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/05/2017
 * Time: 21:54
 */
use app\classes\CommandeFournisseur;
$db = \app\Config::getInstance()->getDatabase();
$cmdFDB = new \app\table\CommandeFournisseurTable($db);
$cmdFs = $cmdFDB->getAll();
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['do']) && $_GET['do'] == 'annuler')
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $cmdF = new \app\table\CommandeFournisseurTable($db);
            $cmd = $cmdF->findById($id);
            $cmd->setEtatvalidation(CommandeFournisseur::ANNULEE);
            $cmdF->update($cmd);
            header('location: commandesFournisseur.php');
        }
    }
    elseif (isset($_GET['do']) && $_GET['do'] == 'passer')
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            $cmdF = new \app\table\CommandeFournisseurTable($db);
            $cmd = $cmdF->findById($id);
            $cmd->setEtatvalidation(CommandeFournisseur::VALIDEE);
            $sujet = "Commande d'un produit";
            $textMail = "LibTech <br/> HAMZA-CHERIF Mohammed Yacine <br/><br/>
                         <strong>Objet commandé : </strong>" . $cmd->getProduit()->getLibelle() . " <br/>
                         <strong>Quantité commandée : </strong> " . $cmd->getQte() . "<br/><br/>
                         Nous vous prions de nous livrer à notre dépôt les marchandises au plus tard. <br/><br/>
                         Le paiement sera effectué aux conditions habituelles, c'est-à-dire par chèque 
                         dès réception de la facture. <br/><br/>
                         Nous vous remercions de bien vouloir nous confirmer notre commande. <br/><br/>
                         Veuillez agréer, Monsieur (Madame), nos salutations distinguées.";
            $headers = "From: \"LibTech\"<libtech013@gmail.com>\n";
            $headers .= "Reply-To: libtech013@gmail.com\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
            $destinataire = $cmd->getProduit()->getStock()->getEmailFournisseur();
            mail($destinataire, $sujet, $textMail, $headers);
            $cmdF->update($cmd);
            header('location: commandesFournisseur.php');
        }
    }
}
?>
<div class="gestionCommandeFournisseur">
    <div class="container">
        <h1 class="text-center">Gestion commande fournisseur</h1>
        <table class="table tablesorter" id="commandeFournisseurTable">
            <thead>
            <tr>
                <th>N°</th>
                <th>Produit</th>
                <th>Employe</th>
                <th>Date</th>
                <th>Quantité Commandée</th>
                <th>Statut</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($cmdFs as $cmdF)
                {
            /**
             * @var $cmdF CommandeFournisseur
             */
                    ?>
                    <tr data-toggle="modal" data-target="#CommandeFournisseurModal" data-id="<?= $cmdF->getNumC()?>">
                        <td><?= $cmdF->getNumC() ?></td>
                        <td><?= $cmdF->getProduit()->getLibelle() ?></td>
                        <td><?= $cmdF->getEmploye()->getNom() . " " . $cmdF->getEmploye()->getPrenom()?></td>
                        <td><?= $cmdF->getDate()?></td>
                        <td><?= $cmdF->getQte()?></td>
                        <td>
                            <?php
                            if ($cmdF->getEtatvalidation() == CommandeFournisseur::EN_COURS_DE_TRAITEMENT)
                                echo "En cours de traitement";
                            elseif ($cmdF->getEtatvalidation() == CommandeFournisseur::VALIDEE)
                                echo "Validée";
                            elseif ($cmdF->getEtatvalidation() == CommandeFournisseur::ANNULEE)
                                echo "Annulée";
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
        <!--Start Modal -->
        <div class="modal fade" id="CommandeFournisseurModal" tabindex="-1" role="dialog" aria-labelledby="CommandeFournisseurModalLabel">

        </div>
        <!--End Modal-->
    </div>
</div>
