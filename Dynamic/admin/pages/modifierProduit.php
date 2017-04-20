<?php
/**
 * Created by PhpStorm.
 * User: FAYSAL
 * Date: 4/1/2017
 * Time: 00:15
 */
use app\Config;
use app\table\ProduitTable;
$db = Config::getInstance()->getDatabase();
$catDb = new \app\table\CategorieTable($db);
$cats = $catDb->getAll();
$produitDb = new ProduitTable($db);
$produit = new \app\classes\Produit();
$caracteristiques = new \app\classes\Caracteristique();
$stock = new \app\classes\Stock();
if ((isset($_GET['do'])) && ($_GET['do'] == 'mod') ){
    //Modifier un produit
    //Afficher tt les informations de produit
    if (!empty($_GET['id']))
    {
        $produit = $produitDb->findById($_GET['id']);
        $caracteristiqueDb = new \app\table\CaracteristiqueTable($db);
        $caracteristiques = $caracteristiqueDb->findByProduit($produit);
        $stockDb = new \app\table\StockTable($db);
        $stock = $stockDb->findById($produit->getIdProduit());
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
        $idProduit = $_POST['idProduit'];
        $refp = $_POST['refP'];
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $nomImage = $_FILES['image']['name'];
        $qte = $_POST['qte'];
        $etat = $_POST['etats'];
        $prix = $_POST['prix'];
        $etatv = $_POST['etatv'];
        $reduction = $_POST['reduction'];
        $emailf = $_POST['emailf'];
        $fb = $_POST['fb'];
        move_uploaded_file($tmp_name, __DIR__.'/../../images/'. $nomImage);
        $nvproduit = new \app\classes\Produit($refp, $categorie, $libelle, $description, $prix, $nomImage, $etatv, $reduction, $fb, $idProduit);
        $produitT = new \app\table\ProduitTable($db);
        $produitT->add($nvproduit);
        $nvproduit = $produitT->findByReference($refp);
        $stockT = new \app\table\StockTable($db);
        $idProduit = $nvproduit->getIdProduit();
        $stock = new \app\classes\Stock($idProduit, $etat, $qte, $emailf);
        $stockT->create($stock);
        $cara = true;
        $i = 1;
        $caracteristiqueDb = new \app\table\CaracteristiqueTable($db);
       while ($cara)
       {
           if (isset($_POST['carnom' . $i])) {
               $caracteristique = new \app\classes\Caracteristique(null, $idProduit, $_POST['carnom' . $i], $_POST['cardesc' . $i]);
                $caracteristiqueDb->create($caracteristique);
           }
           else
               $cara= false;
           $i++;
       }
        header('location: produits.php');
    }
}
?>
<div class="insererProduit text-left">
    <div class="container">
        <h1 class="text-center">Produit</h1>
        <form class="form-horizontal" action="?do=valider" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idProduit" value="<?= $produit->getIdProduit()?>">
            <div class="form-group">
                <label for="refP" class="col-sm-2 control-label">Reference Produit:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="refP" name="refP" placeholder="Reference Produit"
                           required value="<?= $produit->getReferenceProduit() ?>" maxlength="20">
                </div>
            </div>
            <div class="form-group">
                <label for="libelle" class="col-sm-2 control-label">Libelle Produit:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Libelle Produit"
                           required value="<?= $produit->getLibelle() ?>" maxlength="30">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description Produit:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Description Produit" required><?= $produit->getDescription() ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="categorie" class="col-sm-2 control-label">Categorie:</label>
                <div class="col-sm-3">
                    <select name="categorie" id="categorie" class="form-control">
                        <option disabled selected>Categorie</option>
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
            <div class="form-group caracteristique">
                <label class="col-sm-2 control-label">Caractéristiques:</label>
                <?php if (empty($caracteristiques)){?>
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
                <?php }
                else
                {
                    $i = 1;
                    foreach ($caracteristiques as $caracteristique){
                        /**
                         * @var $caracteristique \app\classes\Caracteristique
                         */
                        ?>
                        <div class="col-sm-10 col-sm-offset-2">
                            <div class="col-sm-5">
                                <label for="carnom1" class="col-sm-5 control-label">Nom:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="carnom<?= $i ?>" name="carnom<?= $i ?>"
                                           placeholder="Nom" required value="<?= $caracteristique->getNom() ?>">
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <label for="cardesc1" class="col-sm-2 control-label">Valeur:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cardesc<?= $i ?>" name="cardesc<?= $i ?>"
                                           placeholder="Valeur" required value="<?= $caracteristique->getCaractere() ?>">
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>

                <div>
                    <button type="button" class="btn btn-primary right-float ajouterCaracteristique"><i class="fa fa-plus"></i> Ajouter</button>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-2 control-label">Image du produit:</label>
                <div class="col-sm-10">
                    <input type="file" accept=".jpg, .jpeg" class="form-control" id="image" name="image"
                           placeholder="Chemin photo" required>
                </div>
            </div>
            <div class="form-group">
                <label for="qte" class="col-sm-2 control-label">Quantité:</label>
                <div class="col-sm-3">
                    <input type="number" min="1" class="form-control" id="qte" name="qte" placeholder="Quantité" required
                    value="<?= $stock->getQuantiteDisponible() ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="etats" class="col-sm-2 control-label">Etat de stock:</label>
                <div class="col-sm-3">
                    <select name="etats" id="etats" class="form-control" required>
                        <option disabled selected >Etat de stock</option>
                        <option value="1" <?php if ($stock->getEtat() == \app\classes\Stock::DISPONIBLE ) echo "selected" ?>>
                            En stock</option>
                        <option value="2" <?php if ($stock->getEtat() == \app\classes\Stock::NON_DISPONIBLE ) echo "selected" ?>>
                            En commande</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="prix" class="col-sm-2 control-label">Prix:</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" min="1" class="form-control" id="prix" name="prix"
                               placeholder="Prix" required value="<?= $produit->getPrix() ?>">
                        <div class="input-group-addon">.00 DA</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="etatv" class="col-sm-2 control-label">Etat de vente:</label>
                <div class="col-sm-3">
                    <select name="etatv" id="etatv" class="form-control">
                        <option disabled <?php if ($produit->getEtatVente() == null) echo "selected"?>>
                        Etat de vente
                        </option>
                        <option value="1" <?php if ($produit->getEtatVente() == \app\classes\Produit::SANS_PROMOTION)
                            echo "selected" ?>>
                            Sans promotion
                        </option>
                        <option value="2" <?php if ($produit->getEtatVente() == \app\classes\Produit::EN_PROMOTION)
                            echo "selected" ?>>
                            En promotion
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="reduction" class="col-sm-2 control-label">Réduction:</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" min="0" max="100" step="1" class="form-control" id="reduction" name="reduction"
                               placeholder="Reduction" required value="<?= $produit->getPourcentageReduction() ?>">
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
