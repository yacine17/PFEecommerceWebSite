<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 21:40
 */

namespace app\table;


use app\classes\Commande;

class CommandeTable extends Table
{

    /**
     * Récupérer une commande par son numéro
     * @param $id
     * @return Commande
     */
    public function findById($id){
        $commande = $this->db->prepare("SELECT * FROM commende WHERE numcommande = ?", array($id), Commande::class, true);
        return$commande;
    }

    /**
     * Récupérer tt les Commandes
     * @return array
     */
    public function getAll(){
        $commandes = $this->db->query("SELECT * FROM commende", Commande::class);
        return $commandes;
    }

    /**
     * Insérer une Commande à la base de donnée
     * @param Commande $commande
     */
    public function create(Commande $commande){
        $param = array(
            ':numcommande' => $commande->getNumCommande(),
            ':id' => $commande->getId(),
            ':date' => $commande->getDateCommande(),
            ':adresselivraison' => $commande->getAdresseLivraison(),
            ':etatvalidation' => $commande->getEtatValidation()
        );
        $this->db->prepare("INSERT INTO commende VALUES (:numcommande, :id, :date, :adresselivraison, :etatvalidation)", $param);
    }

    /**
     * Modifer une commande à la base de donnée
     * @param Commande $commande
     */
    public function update(Commande $commande){
        $param = array(
            ':numcommande' => $commande->getNumCommande(),
            ':id' => $commande->getId(),
            ':date' => $commande->getDateCommande(),
            ':adresselivraison' => $commande->getAdresseLivraison(),
            ':etatvalidation' => $commande->getEtatValidation()
        );
        $this->db->prepare("UPDATE commende 
                                SET 
                                date = :date,
                                adresselivraison = :adresselivraison,
                                etatvalidation = :etatvalidation
                                WHERE 
                                numcommande = :numcommande
                                AND id = :id", $param);
    }

    /**
     * Supprimer une commande de la base de donnée
     * @param Commande $commande
     */
    public function delete(Commande $commande){
        $param = array(
            ':numcommande' => $commande->getNumCommande(),
            ':id' => $commande->getId()
        );
        $this->db->prepare("DELETE FROM commende WHERE numcommande = :numcommande AND id = :id", $param);
    }
}