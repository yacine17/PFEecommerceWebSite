<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 06/04/2017
 * Time: 15:35
 */
session_start();
use app\classes\Authentification;
use app\classes\CommandeFournisseur;
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estEmploye())
{
    \app\App::getInstance()->title = 'Gestion des produits';
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';
    $do = !isset($_GET['do']) ? 'home' : $_GET['do'];
    if ($do == 'ajout')
    {
        require 'pages/modifierProduit.php';
    }
    elseif ($do == 'mod')
    {
        require 'pages/modifierProduit.php';
    }
    elseif ($do == 'valider')
    {
        require 'pages/modifierProduit.php';
    }
    elseif ($do == 'supprimer')
    {
        if (isset($_GET['id']) && ctype_digit($_GET['id'])){
            $prodDb = new \app\table\ProduitTable(\app\Config::getInstance()->getDatabase());
            $produit = $prodDb->findById($_GET['id']);
            $prodDb->delete($produit);
            header('locatoin: produits.php');
        }
    }
    elseif (isset($_GET['do']) && $_GET['do'] == 'commander'){
        $id = $_POST['id'];
        $qteCmd = $_POST['quantiteCommandee'];
        $emailF = $_POST['emailFournisseur'];
        $cmdF = new CommandeFournisseur(null, $_SESSION['auth']['id'], $id,
            date("Y-m-d"), $qteCmd, CommandeFournisseur::EN_COURS_DE_TRAITEMENT);
        $db = \app\Config::getInstance()->getDatabase();
        $produitDb = new \app\table\ProduitTable($db);
        $produit = $produitDb->findById($id);
        $produit->getStock()->setEmailFournisseur($emailF);
        $produitDb->updateV2($produit);
        $cmdFDB = new \app\table\CommandeFournisseurTable($db);
        $cmdFDB->create($cmdF);
        header('location: produits.php');
    }
    else
    {
        require 'pages/gestionProduit.php';
    }

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}