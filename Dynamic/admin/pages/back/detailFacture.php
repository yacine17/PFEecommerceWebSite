<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/04/2017
 * Time: 15:23
 */
use app\classes\Facture;

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        require '../../../app/Autoloader.php';
        app\Autoloader::register();
        $idFacture = $_GET['id'];
        $db = \app\Config::getInstance()->getDatabase();
        $factureDb = new \app\table\FactureTable($db);
        $facture = $factureDb->findById($idFacture);
        ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Facture n° <?= $facture->getNumeroFacture() ?></h4>
                </div>
                <form action="?do=valider&id=<?= $facture->getNumeroFacture() ?>" method="post">
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td>N° facture:</td>
                                <td><?= $facture->getNumeroFacture() ?></td>
                            </tr>
                            <tr>
                                <td>N° commande:</td>
                                <td><?= $facture->getNumeroCommande() ?></td>
                            </tr>
                            <tr>
                                <td>Prix hors taxes:</td>
                                <td><?= $facture->getValeurCommande()?>.00 DA</td>
                            </tr>
                            <tr>
                                <td>Taxe:</td>
                                <td><?= $facture->getTaxe() ?>.00 DA</td>
                            </tr>
                            <tr>
                                <td>Prix TTC:</td>
                                <td><?= $facture->getPrixTtc()?>.00 DA</td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td><?= $facture->getDate() ?></td>
                            </tr>
                            <tr>
                                <td>Etat paiement:</td>
                                <td>
                                    <select name="etatPaiement" class="form-control">
                                        <option value="<?= Facture::REGLEE ?>"
                                            <?php if ($facture->getEtatPaiement() == Facture::REGLEE)
                                            echo "selected"?>>
                                            Réglée
                                        </option>
                                        <option value="<?= Facture::NON_REGLEE ?>"
                                            <?php if ($facture->getEtatLivraison() == Facture::NON_REGLEE)
                                            echo "selected"?>>
                                            Non Réglée
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Etat livraison:</td>
                                <td>
                                    <select name="etatLivraison" class="form-control">
                                        <option value="<?= Facture::LIVREE ?>" <?php if ($facture->getEtatLivraison() == Facture::LIVREE)
                                            echo "selected" ?>>Livrée</option>
                                        <option value="<?= Facture::NON_LIVREE ?>" <?php if ($facture->getEtatLivraison() == Facture::NON_LIVREE)
                                            echo "selected" ?>>Non livrée</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Employé:</td>
                                <td><?= strtoupper($facture->getEmploye()->getNom()) . " " . $facture->getEmploye()->getPrenom()?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
                        <a href="imprimerFacture.php?id=<?= $facture->getNumeroFacture() ?>" target="_blank" class="btn btn-primary">
                            <i class="fa fa-print"></i>Imprimer facture
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}