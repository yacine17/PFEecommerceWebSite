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
    private function remplirFacture(Facture $facture)
    {
        $empDb = new EmployeTable($this->db);
        $employe = $empDb->findByID($facture->getIdemploye());
        $facture->setEmploye($employe);
        $comDb = new CommandeTable($this->db);
        $commande = $comDb->findById($facture->getNumeroCommande());
        $facture->setCommande($commande);
        return $facture;
    }
    /**
     * Récupérer une facture par son numéro
     * @param $id
     * @return Facture
     */
    public function findById($id){
        $facture = $this->db->prepare("SELECT * FROM facture WHERE numfacture = ?", array($id), Facture::class, true);
        /**
         * @var $facture Facture
         */
        $facture = $this->remplirFacture($facture);
        return$facture;
    }

    /**
     * Récupérer tt les factures
     * @return array
     */
    public function getAll(){
        $factures = $this->db->query("SELECT * FROM facture", Facture::class);
        $nvFactures = array();
        foreach ($factures as $facture)
        {
            /**
             * @var $facture Facture
             */
            $facture = $this->remplirFacture($facture);
            array_push($nvFactures, $facture);
        }
        return $nvFactures;
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
            ':idemploye' => $facture->getIdemploye()
        );
        $this->db->prepare("INSERT INTO facture VALUES (:numfacture, :numcommande, :valeurcommande, :taxe, :prixttc,
                                                                        :date, :etatpaiement, :etatlivraison, :idemploye)", $param);
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
            ':idemploye' => $facture->getIdemploye()
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
                                idemploye = :idemploye
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

    public function bestEmployes()
    {
       $res = $this->db->query("SELECT idemploye, COUNT(idemploye) as nombreDeCommandes FROM facture GROUP BY idemploye ORDER BY idemploye LIMIT 3");
        $empDb = new EmployeTable($this->db);
        $nvres = array();
       foreach ($res as $re)
        {
            $re->employe = $empDb->findByID($re->idemploye);
            $nvres[] = $re;
        }
        return $nvres;
    }

    public function revenuMensuel()
    {
        $dateAuj = date('Y-m-d');
        $dateAvantMois = date('Y-m-d', strtotime("-1 month"));
        $req = "SELECT * FROM facture WHERE date BETWEEN ? AND ?";
        $factures = $this->db->prepare($req, array($dateAvantMois, $dateAuj), Facture::class);
        $nvFactures = array();
        foreach ($factures as $facture)
        {
            /**
             * @var $facture Facture
             */
            $facture = $this->remplirFacture($facture);
            array_push($nvFactures, $facture);
        }
        $revenu = 0;
        foreach ($nvFactures as $facture)
        {
            /**
             * @var $facture Facture
             */
            $revenu = $revenu + $facture->calculerPrixTTC();
        }
        return $revenu;
    }
    public function clinetsActifs()
    {
        $req = "SELECT count(commande.id) FROM commande, facture 
                WHERE commande.numcommande = facture.numcommande GROUP BY commande.id LIMIT 3";
        $factures = $this->db->query($req, Facture::class);
        var_dump($factures);
        $nvFactures = array();
        foreach ($factures as $facture)
        {
            /**
             * @var $facture Facture
             */
            $facture = $this->remplirFacture($facture);
            array_push($nvFactures, $facture);
        }
        var_dump($nvFactures);
    }
}