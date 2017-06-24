<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 15/04/2017
 * Time: 22:01
 */
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (isset($_GET['do']) && $_GET['do'] == 'supprimerTout')
{
    unset($_SESSION['panier']);
}
elseif (isset($_GET['do']) && $_GET['do'] == 'supprimer')
{
    foreach ($_SESSION['panier'] as $produit) {
        if ($produit['id'] == $_GET['id'])
        {
            $i = array_search($produit, $_SESSION['panier']);
            unset($_SESSION['panier'][$i]);
        }
    }
}
elseif (isset($_GET['do']) && $_GET['do'] == 'changerQuantite')
{
        foreach ($_SESSION['panier'] as $produit)
        {
            if ($produit['id'] == $_GET['id'])
            {
                $i = array_search($produit, $_SESSION['panier']);
                $_SESSION['panier'][$i] = array(
                    'id' => $_GET['id'],
                    'qte' => $_GET['qte']
                );
            }
        }
}
else
{
    if (isset($_GET['id']))
    {
        if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier']))
            $_SESSION['panier'] = array();
        $exist = false;
        foreach ($_SESSION['panier'] as $produit) {
            if ($produit['id'] == $_GET['id'])
                $exist = true;
        }
        if (!$exist)
        {
            $element = array(
                'id' => $_GET['id'],
                'qte' => 1
            );
            array_push($_SESSION['panier'], $element);
            if (isset($_GET['r']) && $_GET['r'] == 'returnProduit')
            {
                $prodDb = new \app\table\ProduitTable(\app\Config::getInstance()->getDatabase());
                $produit = $prodDb->findById($_GET['id']);
                ?>
                <tr data-idProduit="<?= $produit->getIdProduit() ?>" style="display: none">
                    <td><?= count($_SESSION['panier']) ?></td>
                    <td><img src="../images/<?= $produit->getCheminPhoto() ?>"/></td>
                    <td><h4><?= $produit->getLibelle() ?></h4></td>
                    <td><span class="prixUnitaire"><?= $produit->getPrix() ?></span>.00 DA</td>
                    <td><input type="number" min="1" value="1" class="form-control quantiteProduit"><a><i class="fa fa-refresh"></i></a></td>
                    <td><span class="montant"><?= $produit->getPrix()?></span>.00 DA</td>
                    <td><a class="btn btn-danger retirer-produit"
                           href="../pages/gestionPanier.php?do=supprimer&id=<?= $produit->getReferenceProduit() ?>">
                            <i class="fa fa-trash"></i>
                            Retirer
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
        else
            header('500 Internal Server Error', true, 500);
    }
}

