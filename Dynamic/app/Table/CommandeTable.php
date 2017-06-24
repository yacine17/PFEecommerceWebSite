<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 21:40
 */

namespace app\table;


use app\classes\Commande;
use app\classes\Personne;
use app\classes\ProduitCommande;

class CommandeTable extends Table
{
    private function remplirCommande(Commande $commande)
    {
        $prdCmdDb = new ProduitCommandeTable($this->db);
        $prdCmds = $prdCmdDb->findByNumCommande($commande->getNumCommande());
        $commande->setProduitCommandes($prdCmds);
        $perDb = new PersonneTable($this->db);
        $personne = $perDb->findById($commande->getId());
        $commande->setClient($personne);
        return $commande;
    }

    /**
     * Récupérer une commande par son numéro
     * @param $id
     * @return Commande
     */
    public function findById($id){
        $commande = $this->db->prepare("SELECT * FROM commande WHERE numcommande = ?", array($id), Commande::class, true);
        /**
         * @var $commande Commande
         */
        $commande = $this->remplirCommande($commande);
        return $commande;
    }

    /**
     * Récupérer tt les Commandes
     * @return array
     */
    public function getAll(){
        $commandes = $this->db->query("SELECT * FROM commande", Commande::class);
        $nvCommandes = array();
        foreach ($commandes as $commande)
        {
            /**
             * @var $commande Commande
             */
            $commande = $this->remplirCommande($commande);
            array_push($nvCommandes, $commande);
        }
        return $nvCommandes;
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
            ':numeroTelephone' => $commande->getNumeroTelephone(),
            ':etatvalidation' => $commande->getEtatValidation()
        );
        $this->db->prepare("INSERT INTO commande VALUES (:numcommande, :id, :date, :adresselivraison, :numeroTelephone, :etatvalidation)", $param);
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
            ':numeroTelephone' => $commande->getNumeroTelephone(),
            ':etatvalidation' => $commande->getEtatValidation()
        );
        $this->db->prepare("UPDATE commande 
                                SET 
                                date = :date,
                                adresselivraison = :adresselivraison,
                                numeroTelephone = :numeroTelephone,
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
        $this->db->prepare("DELETE FROM commande WHERE numcommande = :numcommande AND id = :id", $param);
    }


    public function createV2(Commande $commande){
        $this->create($commande);
        $produitsCommandes = $commande->getProduitCommandes();
        $id = $this->db->lastInsertedId();
        $prodDb = new ProduitCommandeTable($this->db);
        foreach ($produitsCommandes as $produitC)
        {
            /**
             * @var $produitC ProduitCommande
             */
            $produitC->setIdCommande($id);
            $prodDb->create($produitC);
        }
    }

    public function getByPersonne(Personne $personne)
    {
        $commandes = $this->db->prepare("SELECT * FROM commande WHERE  id = ?", array($personne->getId()), Commande::class);
        $nvCommandes = array();
        foreach ($commandes as $commande)
        {
            /**
             * @var $commande Commande
             */
            $commande = $this->remplirCommande($commande);
            array_push($nvCommandes, $commande);
        }
        return $nvCommandes;
    }

    /**
     * Récuperer les n dernieres commandes
     * @param null $nombre
     * @return array
     */
    public function getLastCommandes($nombre = null)
    {
        $req = "SELECT * FROM commande ORDER BY date DESC";
        if ($nombre != null)
        {
            $req = $req . " LIMIT " . $nombre;
        }
        $commandes = $this->db->query($req, Commande::class);
        $nvCommandes = array();
        foreach ($commandes as $commande)
        {
            /**
             * @var $commande Commande
             */
            $commande = $this->remplirCommande($commande);
            array_push($nvCommandes, $commande);
        }
        return $nvCommandes;
    }
}