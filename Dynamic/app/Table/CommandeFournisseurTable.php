<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/05/2017
 * Time: 20:49
 */

namespace app\table;


use app\classes\CommandeFournisseur;

class CommandeFournisseurTable extends Table
{
    private function remplirObjet(CommandeFournisseur $commandeFournisseur)
    {
        $prodDb = new ProduitTable($this->db);
        $produit = $prodDb->findById($commandeFournisseur->getIdProduit());
        $commandeFournisseur->setProduit($produit);

        $empDb = new EmployeTable($this->db);
        $employe = $empDb->findById($commandeFournisseur->getIdEmploye());
        $commandeFournisseur->setEmploye($employe);
        return $commandeFournisseur;
    }

    /**
     * @param $id
     * @return CommandeFournisseur
     */
    public function findById($id)
    {
        $cmd = $this->db->prepare("SELECT * FROM cmdfournisseur WHERE NumC = ?", array($id), CommandeFournisseur::class, true);
        $cmd = $this->remplirObjet($cmd);
        return $cmd;
    }

    public function getAll()
    {
        $cmds = $this->db->query("SELECT * FROM cmdfournisseur", CommandeFournisseur::class);
        $nvcmd = [];
        foreach ($cmds as $cmd){
            $nvcmd[] = $this->remplirObjet($cmd);
        }
        return $nvcmd;
    }

    public function create(CommandeFournisseur $commandeFournisseur)
    {
        $param = array(
            ':NumC' => $commandeFournisseur->getNumC(),
            ':idEmploye' => $commandeFournisseur->getIdEmploye(),
            ':idProduit' => $commandeFournisseur->getIdProduit(),
            ':date' => $commandeFournisseur->getDate(),
            ':qte' => $commandeFournisseur->getQte(),
            ':etatvalidation' => $commandeFournisseur->getEtatvalidation()
        );
        $req = "INSERT INTO cmdfournisseur VALUES (:NumC, :idEmploye, :idProduit, :date, :qte, :etatvalidation)";
        $this->db->prepare($req, $param);
    }

    public function update(CommandeFournisseur $commandeFournisseur){
        $param = array(
            ':NumC' => $commandeFournisseur->getNumC(),
            ':idEmploye' => $commandeFournisseur->getIdEmploye(),
            ':idProduit' => $commandeFournisseur->getIdProduit(),
            ':date' => $commandeFournisseur->getDate(),
            ':qte' => $commandeFournisseur->getQte(),
            ':etatvalidation' => $commandeFournisseur->getEtatvalidation()
        );
        $req = "UPDATE cmdfournisseur 
                SET idEmploye = :idEmploye,
                idProduit = :idProduit, 
                date = :date,
                qte = :qte,
                etatvalidation = :etatvalidation
                WHERE 
                NumC = :NumC";
        $this->db->prepare($req, $param);
    }
}