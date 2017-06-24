<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 22/04/2017
 * Time: 20:22
 */

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    @ session_start();
    //Charger la classe Autoloader qui s'occupe de chager les autres classes
    require '..\..\app\Autoloader.php';
    app\Autoloader::register();
    if (isset($_GET['do']) && $_GET['do'] == 'validerCommande')
    {
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $idClient = $_SESSION['auth']['id'];
        $nvCommande = new \app\classes\Commande(null, $idClient, date("Y-m-d"), $adresse, $telephone, \app\classes\Commande::EN_COURS_DE_TRAITEMNT);
        foreach ($_SESSION['panier'] as $produit)
        {
            $produitCom = new \app\classes\ProduitCommande($produit['id'], null, $produit['qte']);
            $nvCommande->ajouterProduitCommande($produitCom);
        }
        $comDb = new \app\table\CommandeTable(\app\Config::getInstance()->getDatabase());
        $comDb->createV2($nvCommande);
        unset($_SESSION['panier']);
        header('location: ../../public/');
    }
}
?>
<!-- Modal -->
<div class="modal fade" id="passerCommandeModal" tabindex="-1" role="dialog" aria-labelledby="passerCommandeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="passer-commande">
                        <h1 class="text-center">Passer votre commande</h1>
                        <div class="row">
                            <form action="../pages/templates/passerCommande.php?do=validerCommande" method="post">
                                <div class="col-sm-5 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <textarea maxlength="255" class="form-control" id="adresse" placeholder="Adresse" name="adresse" required></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group-lg">
                                        <label for="adresse">Téléphone</label>
                                        <input type="text" class="form-control" id="telephone" placeholder="Téléphone"  maxlength="10" name="telephone" required>
                                    </div>
                                    <br>
                                    <input type="submit" class="btn btn-primary  btn-lg btn-block" value="Valider la commande">
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
