<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 03/04/2017
 * Time: 22:14
 */
$db = \app\Config::getInstance()->getDatabase();
$factureDb = new \app\table\FactureTable($db);
$factures = $factureDb->getAll();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_GET['do']) && isset($_GET['id']) && !empty($_GET['do']) && !empty(['id']))
    {
        if ($_GET['do'] == 'valider')
        {
            $idFacture = $_GET['id'];
            $facture = $factureDb->findById($idFacture);
            $etatPaiement = $_POST['etatPaiement'];
            $etatLivraison = $_POST['etatLivraison'];
            $facture->setEtatPaiement($etatPaiement);
            $facture->setEtatLivraison($etatLivraison);
            $factureDb->update($facture);
            header('location: ' . $_SERVER['PHP_SELF']);
        }
    }
}
if ($factures)
{
?>
<div class="gestionFacture">
    <div class="container">
        <h1 class="text-center">Gestion des factures</h1>
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher une facture" id="rechercherFacture">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <table class="table tablesorter" id="tableDesFactures">
            <thead>
            <tr>
                <th>N° facture</th>
                <th>Client</th>
                <th>Prix TTC</th>
                <th>Date</th>
                <th>Etat paiment</th>
                <th>Etat livraison</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($factures as $facture)
                {
            /**
             * @var $facture \app\classes\Facture
             */
                    $etatPaiement = ($facture->getEtatPaiement() == \app\classes\Facture::REGLEE) ? 'Réglée' : 'Non réglée';
                    $etatLivraison = ($facture->getEtatLivraison() == \app\classes\Facture::LIVREE) ? 'Livrée' : 'Non livrée';
                    ?>
                    <tr data-toggle="modal" data-target="#factureModal" data-id="<?= $facture->getNumeroFacture() ?>">
                        <td><?= $facture->getNumeroFacture() ?></td>
                        <td><?= strtoupper($facture->getCommande()->getClient()->getNom()) . " " . $facture->getCommande()->getClient()->getPrenom() ?></td>
                        <td><?= $facture->getPrixTtc() ?>.00 DA</td>
                        <td><?= $facture->getDate() ?></td>
                        <td><?= $etatPaiement ?></td>
                        <td><?= $etatLivraison ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!--Start modal-->
        <div class="modal fade" id="factureModal" tabindex="-1" role="dialog" aria-labelledby="factureModalLabel">

        </div>
        <!--End Modal-->
    </div>
</div>
<?php
}//fin if ($factures)
else
{
    echo "<br><br><br><div class='container'><div class='alert alert-danger'>La liste des factures est vide</div> </div>";
}