<?php
/**
 * Created by PhpStorm.
 * User: FAYSAL
 * Date: 4/1/2017
 * Time: 00:15
 */
//$_POST['refP'];
//$_POST['libelle'];
//$_POST['categorie'];
//$_POST['carnom1'];
//$_POST['cardesc1'];
//$_POST['photo'];
//$_POST['qte'];
//$_POST['etats'];
//$_POST['prix'];
//$_POST['etatv'];
//$_POST['reduction'];
//$_POST['emailf'];
//$_POST['fb'];
use app\Config;
use app\table\ProduitTable;
$db = Config::getInstance()->getDatabase();
$catDb = new \app\table\CategorieTable($db);
$cats = $catDb->getAll();
$produitDb = new ProduitTable($db);
$produit = new \app\classes\Produit();
if ((isset($_GET['do'])) && ($_GET['do'] == 'mod') ){
    //Modifier un produit
    //Afficher tt les informations de produit
    if (!empty($_GET['id']) && ctype_digit($_GET['id']))//Id est un entier
    {
        $produit = $produitDb->findById($_GET['id']);
        if (!$produit)
        {
            //TODO Produit n'existe pas
        }
    }
}
elseif ((isset($_GET['do'])) && ($_GET['do'] == 'ajout') )
{
    //Ajouter un nouveau produit
}
elseif((isset($_GET['do'])) && ($_GET['do'] == 'valider'))
{
    if(isset($_POST['refP']) && !empty($_POST['refP'])) {
        $db = \app\Config::getInstance()->getDatabase();
        $refp = $_POST['refP'];
        $libelle = $_POST['libelle'];
        $categorie = $_POST['categorie'];
        $_POST['carnom1'];
        $_POST['cardesc1'];
        $photo = $_POST['photo'];
        $qte = $_POST['qte'];
        $etat = $_POST['etats'];
        $prix = $_POST['prix'];
        $etatv = $_POST['etatv'];
        $reduction = $_POST['reduction'];
        $emailf = $_POST['emailf'];
        $fb = $_POST['fb'];
        $cattable = new \app\table\CategorieTable($db);
        $cat = $cattable->findById($categorie);
        $cat->setNbrProduit($cat->getNbrProduit() + $qte);
        $cattable->update($cat);
        $nvproduit = new \app\classes\Produit($refp, $categorie, $libelle, $prix, $photo, $etatv, $reduction, $fb);
        $produitT = new \app\table\ProduitTable($db);
        $produitT->create($nvproduit);
        $stockT = new \app\table\StockTable($db);
        $stock = new \app\classes\Stock($refp, $categorie, $etat, $qte, $emailf);
        $stockT->create($stock);
        //header('location: produits.php');
    }
}
?>
<div class="insererProduit text-left">
    <div class="container">
        <h1 class="text-center">Produit</h1>
        <form class="form-horizontal" action="?do=valider" method="post">
            <div class="form-group">
                <label for="refP" class="col-sm-2 control-label">Reference Produit:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="refP" name="refP" placeholder="Reference Produit" required value="<?= $produit->getReferenceProduit() ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="libelle" class="col-sm-2 control-label">Libelle Produit:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Libelle Produit" required value="<?= $produit->getLibelle() ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="categorie" class="col-sm-2 control-label">Categorie:</label>
                <div class="col-sm-3">
                    <select name="categorie" id="categorie" class="form-control">
                        <?php
                            foreach ($cats as $cat){
                                /** @var $cat \app\classes\Categorie */
                                $sel = ($cat->getIdCategorie() == $produit->getIdCategorie()) ? 'selected' : '';
                                echo "<option value='" . $cat->getIdCategorie() . "' $sel>" .  $cat->getNom() . "</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Caractéristiques:</label>
                <div class="col-sm-10 col-sm-offset-2">
                    <div class="col-sm-5">
                        <label for="carnom1" class="col-sm-5 control-label">Nom:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="carnom1" name="carnom1" placeholder="Nom" required>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <label for="cardesc1" class="col-sm-2 control-label">Valeur:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cardesc1" name="cardesc1" placeholder="Valeur" required>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary right-float"><i class="fa fa-plus"></i> Ajouter</button>
                </div>
            </div>
            <div class="form-group">
                <label for="photo" class="col-sm-2 control-label">Chemin photo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="photo" name="photo" placeholder="Chemin photo" required value="<?= $produit->getCheminPhoto() ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="qte" class="col-sm-2 control-label">Quantité:</label>
                <div class="col-sm-3">
                    <input type="number" step="10" class="form-control" id="qte" name="qte" placeholder="Quantité" required>
                </div>
            </div>
            <div class="form-group">
                <label for="etats" class="col-sm-2 control-label">Etat:</label>
                <div class="col-sm-3">
                    <select name="etats" id="etats" class="form-control">
                        <option disabled selected>Etat</option>
                        <option value="1">En stock</option>
                        <option value="2">En commande</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="prix" class="col-sm-2 control-label">Prix:</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" step="50" class="form-control" id="prix" name="prix" placeholder="Prix" required value="<?= $produit->getPrix() ?>">
                        <div class="input-group-addon">.00 DA</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="etatv" class="col-sm-2 control-label">Etat de vente:</label>
                <div class="col-sm-3">
                    <select name="etatv" id="etatv" class="form-control">
                        <option disabled>Etat de vente</option>
                        <?php if ($produit->getEtatVente() == \app\classes\Produit::SANS_PROMOTION)
                            echo " <option value=\"1\" selected>Sans promotion</option>
                                    <option value=\"2\">En promotion</option>";
                            else
                                echo "<option value=\"1\">Sans promotion</option>
                                        <option value=\"2\" selected>En promotion</option>";
                        ?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="reduction" class="col-sm-2 control-label">Réduction:</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" step="1" class="form-control" id="reduction" name="reduction" placeholder="Reduction" required value="<?= $produit->getPourcentageReduction() ?>">
                        <div class="input-group-addon">%</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="emailf" class="col-sm-2 control-label">Email fournisseur</label>
                <div class="col-sm-3">
                    <input type="email" class="form-control" id="emailf" name="emailf" placeholder="Email fournisseur">
                </div>
            </div>
            <div class="form-group">
                <label for="fb" class="col-sm-2 control-label">Lien facebook</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="fb" name="fb" placeholder="Lien facebook">
                </div>
            </div>
            <div class="form-group">
                <div class="right-float">
                    <input type="submit" class=" btn btn-primary">
                    <input type="reset" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>
</div>

