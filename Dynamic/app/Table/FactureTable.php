<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 26/03/2017
 * Time: 16:14
 */

namespace app\table;


use app\classes\Facture;

class FactureTable extends Table
{
    /**
     * Récupérer une facture par son numéro
     * @param $id
     * @return Facture
     */
    public function findById($id){
        $facture = $this->db->prepare("SELECT * FROM facture WHERE numfacture = ?", array($id), Facture::class, true);
        return $facture;
    }

    /**
     * Récupérer tt les factures
     * @return array
     */
    public function getAll(){
        $factures = $this->db->query("SELECT * FROM facture", Facture::class);
        return $factures;
    }

    /**
     * Insérer une facture à la base de donnée
     * @param Facture $facture
     */
    public function create(Facture $facture){
        $param = array(
            ':numfacture' => $facture->getNumeroFacture(),
            ':numcommande' => $facture->getNumeroCommande(),
            ':valeurcommande' => $facture->getValeurCommande(),
            ':taxe' => $facture->getTaxe(),
            ':prixttc' => $facture->getPrixTtc(),
            ':date' => $facture->getDate(),
            ':etatpaiement' => $facture->getEtatPaiement(),
            ':etatlivraison' => $facture->getEtatLivraison(),
            ':numemploye' => $facture->getNumeroEmploye()
        );
        $this->db->prepare("INSERT INTO facture VALUES (:numfacture, :numcommande, :valeurcommande, :taxe, :prixttc,
                                                                        :date, :etatpaiement, :etatlivraison, :numemploye)", $param);
    }

    /**
     * Modifier une facture à la base de donnée
     * @param Facture $facture
     */
    public function update(Facture $facture){
        $param = array(
            ':numfacture' => $facture->getNumeroFacture(),
            ':numcommande' => $facture->getNumeroCommande(),
            ':valeurcommande' => $facture->getValeurCommande(),
            ':taxe' => $facture->getTaxe(),
            ':prixttc' => $facture->getPrixTtc(),
            ':date' => $facture->getDate(),
            ':etatpaiement' => $facture->getEtatPaiement(),
            ':etatlivraison' => $facture->getEtatLivraison(),
            ':numemploye' => $facture->getNumeroEmploye()
        );
        $this->db->prepare("UPDATE facture 
                                SET
                                numcommande = :numcommande, 
                                valeurcommande = :valeurcommande, 
                                taxe = :taxe, 
                                prixttc = :prixttc, 
                                date = :date, 
                                etatpaiement = :etatpaiement, 
                                etatlivraison = :etatlivraison, 
                                numemploye = :numemploye
                                WHERE 
                                numfacture = :numfacture", $param);
    }

    /**
     * Supprimer une facture à la base de donnée
     * @param Facture $facture
     */
    public function delete(Facture $facture){
        $this->db->prepare("DELETE FROM facture WHERE numfacture = ?", array($facture->getNumeroFacture()));
    }

}