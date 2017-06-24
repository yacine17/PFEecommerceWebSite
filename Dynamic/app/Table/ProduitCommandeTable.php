<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 22:50
 */

namespace app\table;


use app\classes\Commande;
use app\classes\ProduitCommande;

class ProduitCommandeTable extends Table
{
    private function remplirProduitCommande (ProduitCommande $produitCommande)
    {
        $prodDb = new ProduitTable($this->db);
        $produit = $prodDb->findById($produitCommande->getIdProduit());
        $produitCommande->setProduit($produit);
        return $produitCommande;
    }

    /**
     * Récupérer produitCommandé par son id
     * @param $idProduit
     * @param $idCommande
     * @return ProduitCommande
     */
    public function findById($idProduit, $idCommande){
        $param = array(
            ':idProduit' => $idProduit,
            ':idcmd' => $idCommande
        );
        $prodCmd = $this->db->prepare("SELECT * FROM produitcommande WHERE idProduit = :idProduit AND idcmd = :idcmd", $param, ProduitCommande::class, true);
        $prodCmd = $this->remplirProduitCommande($prodCmd);
        return $prodCmd;
    }

    /**
     * Récupérer tt les ProduitCommandeé
     * @return array
     */
    public function getAll(){
        $prodsCmds = $this->db->query("SELECT * FROM produitcommande", ProduitCommande::class);
        $nvProdsCmds = array();
        foreach ($prodsCmds as $prodCmd)
        {
            /**
             * @var $prodCmd ProduitCommande
             */
            $prodCmd = $this->remplirProduitCommande($prodCmd);
            array_push($nvProdsCmds, $prodCmd);
        }
        return $nvProdsCmds;
    }

    /**
     * @param $idCommande
     * @return array|mixed
     */
    public function findByNumCommande($idCommande){
        $produitsCommandes = $this->db->prepare("SELECT * FROM produitcommande WHERE idcmd = ?", array($idCommande), ProduitCommande::class);
        $nvProdsCmds = array();
        foreach ($produitsCommandes as $prodCmd)
        {
            /**
             * @var $prodCmd ProduitCommande
             */
            $prodCmd = $this->remplirProduitCommande($prodCmd);
            array_push($nvProdsCmds, $prodCmd);
        }
        return $nvProdsCmds;
    }

    /**
     * Insérer un produit commandé
     * @param ProduitCommande $produitCommande
     */
    public function create(ProduitCommande $produitCommande){
        $param = array(
            ':idProduit' => $produitCommande->getIdProduit(),
            ':idcmd' => $produitCommande->getIdCommande(),
            ':qte' => $produitCommande->getQuantite()
        );
        $this->db->prepare("INSERT INTO produitcommande VALUES (:idProduit, :idcmd, :qte)", $param);
    }

    /**
     * Modifier un produit commandé
     * @param ProduitCommande $produitCommande
     */
    public function update(ProduitCommande $produitCommande){
        $param = array(
            ':idProduit' => $produitCommande->getIdProduit(),
            ':idcmd' => $produitCommande->getIdCommande(),
            ':qte' => $produitCommande->getQuantite()
        );
        $this->db->prepare("UPDATE produitcommande 
                                SET 
                                qte = :qte
                                WHERE 
                                idProduit = :idProduit AND
                                idcmd = :idcmd", $param);
    }

    /**
     * Supprimer un produit commandé
     * @param ProduitCommande $produitCommande
     */
    public function delete(ProduitCommande $produitCommande){
        $param = array(
            ':idProduit' => $produitCommande->getIdProduit(),
            ':idcmd' => $produitCommande->getIdCommande()
        );
        $this->db->prepare("DELETE FROM produitcommande WHERE idProduit = :idProduit AND idcmd = :idcmd", $param);
    }
}