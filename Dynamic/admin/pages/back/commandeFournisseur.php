<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/05/2017
 * Time: 22:27
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        require '../../../app/Autoloader.php';
        app\Autoloader::register();
        $id = $_GET['id'];
        $db = \app\Config::getInstance()->getDatabase();
        $cmdFDB = new \app\table\CommandeFournisseurTable($db);
        $commandeF = $cmdFDB->findById($id);
        if ($commandeF) {
            ?>
            <!--Start Modal-->
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="text-center">Détails Commande n° <?= $commandeF->getNumC() ?></h2>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td>Produit</td>
                                <td><?= $commandeF->getProduit()->getLibelle() ?></td>
                            </tr>
                            <tr>
                                <td>Quanitité disponible</td>
                                <td><?= $commandeF->getProduit()->getStock()->getQuantiteDisponible()?></td>
                            </tr>
                            <tr>
                                <td>Quantité commandée</td>
                                <td><?= $commandeF->getQte() ?></td>
                            </tr>
                            <tr>
                                <td>Email fournisseur</td>
                                <td><?= $commandeF->getProduit()->getStock()->getEmailFournisseur()?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <?php
                        $etatButtons = "";
                        if ($commandeF->getEtatvalidation() != \app\classes\CommandeFournisseur::EN_COURS_DE_TRAITEMENT)
                            $etatButtons = "disabled";
                        ?>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Reporter</button>
                        <a class="btn btn-danger" <?= $etatButtons?>
                           href="?do=annuler&id=<?= $commandeF->getNumC()?>" >Annuler la commande</a>
                        <a class="btn btn-primary" <?= $etatButtons?>
                            href="?do=passer&id=<?= $commandeF->getNumC()?>">Passer la commande</a>
                    </div>
                </div>
            </div>
            <!--End Modal-->
            <?php
        }
    }
}