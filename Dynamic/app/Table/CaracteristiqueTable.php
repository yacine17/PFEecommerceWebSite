<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 19:57
 */

namespace app\table;


use app\classes\Caracteristique;
use app\classes\Produit;

class CaracteristiqueTable extends Table
{

    /**
     * Récupérer une caracteristique a partir de son id
     * @param $id
     * @return Caracteristique|false
     */
    public function findById($id){
        $car = $this->db->prepare("SELECT * FROM caracteristique WHERE idcaracteristique = ?", array($id), Caracteristique::class, true);
        return $car;
    }

    /**
     * Récupérer tous les caractestique d'un produit
     * @param $produit
     * @return array|mixed
     */
    public function findByProduit(Produit $produit)
    {
        $car = $this->db->prepare("SELECT * FROM caracteristique WHERE idProduit = ?", array($produit->getIdProduit()), Caracteristique::class);
        return $car;
    }
    /**
     * Récupérer des caracteristiques a partir d'un nom
     * @param $nom
     * @return array|Caracteristique|false
     */
    public function findByName($nom){
        $car = $this->db->prepare("SELECT * FROM caracteristique WHERE nom = ?", array($nom), Caracteristique::class);
        return $car;
    }

    /**
     * Récupérer tt les caracteristiques
     * @return array
     */
    public function getAll(){
        $cars = $this->db->query("SELECT * FROM caracteristique", Caracteristique::class);
        return $cars;
    }

    /**
     * Insérer une caracteristique à la base de donnée
     * @param Caracteristique $caracteristique
     */
    public function create(Caracteristique $caracteristique){
        $param = array(
            ':idcaracteristique' => $caracteristique->getIdCaracteristique(),
            ':idProduit' => $caracteristique->getIdProduit(),
            ':nom' => $caracteristique->getNom(),
            ':caractere' => $caracteristique->getCaractere()
        );
        $this->db->prepare("INSERT INTO caracteristique VALUES (:idcaracteristique, :idProduit, :nom, :caractere)", $param);
    }

    /**
     * Modifier une caracteristique à la base de donnée
     * @param Caracteristique $caracteristique
     */
    public function update(Caracteristique $caracteristique){
        $param = array(
            ':idcaracteristique' => $caracteristique->getIdCaracteristique(),
            ':idProduit' => $caracteristique->getIdProduit(),
            ':nom' => $caracteristique->getNom(),
            ':caractere' => $caracteristique->getCaractere()
        );
        $this->db->prepare("UPDATE caracteristique
                                SET
                                idProduit = :idProduit,
                                nom = :nom,
                                caractere = :caractere
                                WHERE idcaracteristique = :idcaracteristique", $param);
    }

    /**
     * Supprimer une caracteristique de la base de donnée
     * @param Caracteristique $caracteristique
     */
    public function delete(Caracteristique $caracteristique){
        $this->db->prepare("DELETE FROM caracteristique WHERE idcaracteristique = ?", array($caracteristique->getIdCaracteristique()));
    }
}