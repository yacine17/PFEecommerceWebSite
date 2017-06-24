<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/05/2017
 * Time: 19:13
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id']))
    {
        require '../../../app/Autoloader.php';
        app\Autoloader::register();
        $prodDb = new \app\table\ProduitTable(\app\Config::getInstance()->getDatabase());
        $produit = $prodDb->findById($_GET['id']);
        if ($produit) {
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?do=commander" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Commander <?= $produit->getLibelle() ?></h4>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tr>
                                    <td>Réference :</td>
                                    <td><?= $produit->getReferenceProduit() ?></td>
                                </tr>
                                <tr>
                                    <td>Quantité Disponible :</td>
                                    <td><?= $produit->getStock()->getQuantiteDisponible() ?></td>
                                </tr>
                                <tr>
                                    <td>Email fournisseur :</td>
                                    <td><input type="email" class="form-control" name="emailFournisseur"
                                        value="<?= $produit->getStock()->getEmailFournisseur()?>"
                                        placeholder="Email fournisseur" required></td>
                                </tr>
                                <tr>
                                    <td>Quantité à commandée :</td>
                                    <td><input type="number" min="1" name="quantiteCommandee" class="form-control"
                                        placeholder="Quantité à commandée"></td>
                                </tr>
                            </table>
                            <input type="hidden" name="id" value="<?= $produit->getIdProduit() ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Passer la commande</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    }
}