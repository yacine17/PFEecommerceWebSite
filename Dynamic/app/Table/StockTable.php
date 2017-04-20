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
     * @param $referenceProduit
     * @param $idCategorie
     * @return Stock
     */
    public function findById($referenceProduit, $idCategorie) {
        $stock = $this->db->prepare("SELECT * FROM stock WHERE referencep = ? AND idcategorie = ?", array($referenceProduit, $idCategorie), Stock::class, true);
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
            ':referencep' => $stock->getReferenceProduit(),
            ':etat' => $stock->getIdCategorie(),
            ':qtedispo' => $stock->getQuantiteDisponible(),
            ':emailfournisseur' => $stock->getEmailFournisseur()
        );
        $this->db->prepare("INSERT INTO stock VALUES (:referencep, :etat, :qtedispo, :emailfournisseur)", $param);
    }

    /**
     * Modifier un stock à la base de donnée
     * @param Stock $stock
     */
    public function update(Stock $stock){
        $param = array(
            ':referencep' => $stock->getReferenceProduit(),
            ':etat' => $stock->getIdCategorie(),
            ':qtedispo' => $stock->getQuantiteDisponible(),
            ':emailfournisseur' => $stock->getEmailFournisseur()
        );
        $this->db->prepare("UPDATE stock 
                                SET 
                                etat = :etat,
                                qtedispo = :qtedispo,
                                emailfournisseur = :emailfournisseur
                                WHERE 
                                referencep = :referencep", $param);
    }

    /**
     * Supprimer un stock à la base de donnée
     * @param Stock $stock
     */
    public function delete(Stock $stock){
        $param = array(
            ':referencep' => $stock->getReferenceProduit()
        );
        $this->db->prepare("DELETE FROM stock
                                  WHERE referencep = :referencep", $param);
    }
}