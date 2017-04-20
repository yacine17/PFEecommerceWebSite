<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 26/03/2017
 * Time: 14:36
 */

namespace app\table;


use app\classes\Stock;

class StockTable extends Table
{
    /**
     * Récupérer un produit stocké par son id
     * @param $idProduit
     * @return Stock
     */
    public function findById($idProduit) {
        $stock = $this->db->prepare("SELECT * FROM stock WHERE idProduit = ?", array($idProduit), Stock::class, true);
        return $stock;
    }

    /**
     * Récupérer tt le stock
     * @return array
     */
    public function getAll(){
        return $this->db->query("SELECT * FROM stock", Stock::class);
    }

    /**
     * Insérer un stock à la base de donnée
     * @param Stock $stock
     */
    public function create(Stock $stock){
        $param = array(
            ':idProduit' => $stock->getIdProduit(),
            ':etat' => $stock->getEtat(),
            ':qtedispo' => $stock->getQuantiteDisponible(),
            ':emailfournisseur' => $stock->getEmailFournisseur()
        );
        $this->db->prepare("INSERT INTO stock VALUES (:idProduit, :etat, :qtedispo, :emailfournisseur)", $param);
    }

    /**
     * Modifier un stock à la base de donnée
     * @param Stock $stock
     */
    public function update(Stock $stock){
        $param = array(
            ':idProduit' => $stock->getIdProduit(),
            ':etat' => $stock->getEtat(),
            ':qtedispo' => $stock->getQuantiteDisponible(),
            ':emailfournisseur' => $stock->getEmailFournisseur()
        );
        $this->db->prepare("UPDATE stock 
                                SET 
                                etat = :etat,
                                qtedispo = :qtedispo,
                                emailfournisseur = :emailfournisseur
                                WHERE 
                                idProduit = :idProduit", $param);
    }

    /**
     * Supprimer un stock à la base de donnée
     * @param Stock $stock
     */
    public function delete(Stock $stock){
        $param = array(
            ':idProduit' => $stock->getIdProduit()
        );
        $this->db->prepare("DELETE FROM stock
                                  WHERE idProduit = :idProduit", $param);
    }
}