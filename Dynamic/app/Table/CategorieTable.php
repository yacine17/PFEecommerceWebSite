<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 22:19
 */

namespace app\table;


use app\classes\Categorie;

class CategorieTable extends Table
{
    /**
     * Récupérer une categorie a partir de son id
     * @param $id
     * Retourne une categorie s'elle existe sinon false
     * @return Categorie|false
     */
    public function findById($id){
        $cat = $this->db->prepare("SELECT * FROM categorie WHERE idcategorie = ?", array($id), Categorie::class, true);
        return $cat;
    }

    /**
     * Récupérer une categorie a partir de son nom
     * @param $nom
     * Retourne une categorie s'elle existe sinon false
     * @return Categorie|false
     */
    public function findByName($nom){
        $cat = $this->db->prepare("SELECT * FROM categorie WHERE nom = ?", array($nom), Categorie::class, true);
        return $cat;
    }

    /**
     * Récupérer tt les categories
     * @return array(Categorie)|false
     */
    public function getAll(){
        $cats = $this->db->query("SELECT * FROM categorie", Categorie::class);
        return $cats;
    }

    /**
     * Insérer une nouvelle categorie à la base de donnée
     * @param Categorie $categorie
     */
    public function create(Categorie $categorie){
        $param = array(
            ':idcategorie' => $categorie->getIdCategorie(),
            ':nom' => $categorie->getNom(),
            ':catprincipale' => $categorie->getCategoriePrincipale()
        );
        $this->db->prepare("INSERT INTO categorie (idcategorie, nom, catprincipale, nbrproduit) VALUES (:idcategorie, :nom, :catprincipale)", $param);
    }

    /**
     * Modifier une categorie a la base de donnée
     * @param Categorie $categorie
     */
    public function update(Categorie $categorie){
        $param = array(
            ':nom' => $categorie->getNom(),
            ':catprincipale' => $categorie->getCategoriePrincipale(),
            ':idcategorie' => $categorie->getIdCategorie()
        );
        $this->db->prepare("UPDATE categorie SET
                                 nom = :nom,
                                 catprincipale = :catprincipale
                                 WHERE idcategorie = :idcategorie", $param);
    }

    /**
     * Supprimer une categorie de la base de donnée
     * @param Categorie $categorie
     */
    public function delete(Categorie $categorie){
        $this->db->prepare("DELETE FROM categorie WHERE idcategorie = ?", array($categorie->getIdCategorie()));
    }


}