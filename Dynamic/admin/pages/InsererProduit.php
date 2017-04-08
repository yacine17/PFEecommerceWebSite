<?php
/**
 * Created by PhpStorm.
 * User: FAYSAL
 * Date: 4/1/2017
 * Time: 00:15
 */
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['refP']) && !empty($_POST['refP'])){
        $db=\app\Config::getInstance()->getDatabase();
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
        $cat=$cattable->findById($categorie);
        $cat->setNbrProduit($cat->getNbrProduit()+$qte);
        $cattable->update($cat);
        $produit = new \app\classes\Produit($refp,$categorie, $libelle, $prix, $photo, $etatv, $reduction,$fb);
        $produitT=new \app\table\ProduitTable($db);
        $produitT->create($produit);
        $stockT=new \app\table\StockTable($db);
        $stock=new \app\classes\Stock($refp,$categorie,$etat,$qte,$emailf);
        var_dump($stock);
        $stockT->create($stock);
    }
}?>
<div class="insererProduit text-left">
    <div class="container">
        <form class="form-horizontal" action="" method="post">
            <div class="form-group">
                <label for="refP" class="col-sm-2 control-label">Reference Produit:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="refP" name="refP" placeholder="Reference Produit" required>
                </div>
            </div>
            <div class="form-group">
                <label for="libelle" class="col-sm-2 control-label">Libelle Produit:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="libelle" name="libelle" placeholder="Libelle Produit" required>
                </div>
            </div>
            <div class="form-group">
                <label for="categorie" class="col-sm-2 control-label">Categorie:</label>
                <div class="col-sm-3">
                    <select name="categorie" id="categorie" class="form-control">
                        <option disabled selected>Categorie</option>
                        <option value="1">Papeterie</option>
                        <option value="2">Bureautique</option>
                        <option value="3">Informatique</option>
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
                    <input type="text" class="form-control" id="photo" name="photo" placeholder="Chemin photo" required>
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
                        <input type="number" step="50" class="form-control" id="prix" name="prix" placeholder="Prix" required>
                        <div class="input-group-addon">.00 DA</div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="etatv" class="col-sm-2 control-label">Etat de vente:</label>
                <div class="col-sm-3">
                    <select name="etatv" id="etatv" class="form-control">
                        <option disabled selected>Etat de vente</option>
                        <option value="1">Sans promotion</option>
                        <option value="2">En promotion</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="reduction" class="col-sm-2 control-label">Réduction:</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="number" step="1" class="form-control" id="reduction" name="reduction" placeholder="Reduction" required>
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

