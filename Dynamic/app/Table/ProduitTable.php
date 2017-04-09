<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 17:54
 */

namespace app\table;


use app\classes\Personne;
use app\classes\Produit;

class ProduitTable extends Table
{
    /**
     * Récupérer un produit a partir de son id
     * @param $id
     * @return Produit|false
     */
    public function findById($id){
        $produit = $this->db->prepare("SELECT * FROM produit WHERE referencep = ?", array($id), Produit::class, true);
        return $produit;
    }

    /**
     * Récupérer un produit a partir de son nom
     * @param $nom
     * @return Produit|false
     */
    public function findByName($nom){
        $produit = $this->db->prepare("SELECT * FROM produit WHERE libelle = ?", array($nom), Produit::class, true);
        return $produit;
    }

    /**
     * Récupérer tt les produit
     * @return array(Produit)
     */
    public function getAll(){
        $produits = $this->db->query("SELECT * FROM produit", Produit::class);
        return $produits;
    }

    /**
     * Insérer un produit à la base de donnée
     * @param Produit $produit
     */
    public function create(Produit $produit){
        $param = array(
            ':referencep' => $produit->getReferenceProduit(),
            ':idcategorie' => $produit->getIdCategorie(),
            ':libelle' => $produit->getLibelle(),
            ':prix' => $produit->getPrix(),
            ':cheminphoto' => $produit->getCheminPhoto(),
            ':etatvente' => $produit->getEtatVente(),
            ':pourcentagereduction' => $produit->getPourcentageReduction(),
        );
        $this->db->prepare("INSERT INTO produit VALUES (:referencep, :idcategorie, :libelle, :prix, :cheminphoto, :etatvente, :pourcentagereduction)", $param);
    }

    /**
     * Modifier un produit à la base de donnée
     * @param Produit $produit
     */
    public function update(Produit $produit){
        $param = array(
            ':referencep' => $produit->getReferenceProduit(),
            ':idcategorie' => $produit->getIdCategorie(),
            ':idcaracteristique' => null,
            ':libelle' => $produit->getLibelle(),
            ':prix' => $produit->getPrix(),
            ':cheminphoto' => $produit->getCheminPhoto(),
            ':etatvente' => $produit->getEtatVente(),
            ':pourcentagereduction' => $produit->getPourcentageReduction()
        );
        $this->db->prepare("UPDATE produit SET 
                                  idcategorie = :idcategorie,
                                  idcaracteristique = :idcaracteristique,
                                  libelle = :libelle,
                                  prix = :prix,
                                  cheminphoto = :cheminphoto,
                                  etatvente = :etatvente,
                                  pourcentagereduction = :pourcentagereduction
                                  WHERE referencep = :referencep", $param);
    }

    /**
     * Supprimer un produit de la base de donnée
     * @param Produit $produit
     */
    public function delete(Produit $produit){
        $this->db->prepare("DELETE FROM produit WHERE referencep = ?", array($produit->getReferenceProduit()));
    }

    /**Modifier un produit s'il existe sinon l'insérer
     * @param Produit $produit
     */
    public function add(Produit $produit){
        if ($this->findById($produit->getReferenceProduit()))
            $this->update($produit);
        else
            $this->create($produit);
    }

}