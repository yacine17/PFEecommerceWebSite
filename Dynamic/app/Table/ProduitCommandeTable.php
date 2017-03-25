<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 22:50
 */

namespace app\table;


use app\classes\ProduitCommande;

class ProduitCommandeTable extends Table
{

    /**
     * Récupérer produitCommandé par son id
     * @param $referenceProduit
     * @param $idCommande
     * @return ProduitCommande
     */
    public function findById($referenceProduit, $idCommande){
        $param = array(
            ':refproduit' => $referenceProduit,
            ':idcmd' => $idCommande
        );
        $prodCmd = $this->db->prepare("SELECT * FROM produitcommande WHERE refproduit = :refproduit AND idcmd = :idcmd", $param, ProduitCommande::class, true);
        return $prodCmd;
    }

    /**
     * Récupérer tt les ProduitCommandeé
     * @return array
     */
    public function getAll(){
        return $this->db->query("SELECT * FROM produitcommande", ProduitCommande::class);
    }

    /**
     * Insérer un produit commandé
     * @param ProduitCommande $produitCommande
     */
    public function create(ProduitCommande $produitCommande){
        $param = array(
            ':refproduit' => $produitCommande->getReferenceProduit(),
            ':idcmd' => $produitCommande->getIdCommande(),
            ':qte' => $produitCommande->getQuantite()
        );
        $this->db->prepare("INSERT INTO produitcommande VALUES (:refproduit, :idcmd, :qte)", $param);
    }

    /**
     * Modifier un produit commandé
     * @param ProduitCommande $produitCommande
     */
    public function update(ProduitCommande $produitCommande){
        $param = array(
            ':refproduit' => $produitCommande->getReferenceProduit(),
            ':idcmd' => $produitCommande->getIdCommande(),
            ':qte' => $produitCommande->getQuantite()
        );
        $this->db->prepare("UPDATE produitcommande 
                                SET 
                                qte = :qte
                                WHERE 
                                refproduit = :refproduit AND
                                idcmd = :idcmd", $param);
    }

    /**
     * Supprimer un produit commandé
     * @param ProduitCommande $produitCommande
     */
    public function delete(ProduitCommande $produitCommande){
        $param = array(
            ':refproduit' => $produitCommande->getReferenceProduit(),
            ':idcmd' => $produitCommande->getIdCommande()
        );
        $this->db->prepare("DELETE FROM produitcommande WHERE refproduit = :refproduit AND idcmd = :idcmd", $param);
    }
}