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
        $produit = $this->db->prepare("SELECT * FROM produit WHERE idProduit = ?", array($id), Produit::class, true);
        return $produit;
    }


    /**
     * Récupérer un produit a partir de reference
     * @param $reference
     * @return Produit
     */
    public function findByReference($reference){
        $produit = $this->db->prepare("SELECT * FROM produit WHERE referencep = ?", array($reference), Produit::class, true);
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
     * Récupérer tt les produits d'une categorie
     * @param $idCat
     * @return array|mixed
     */
    public function getByCategorie($idCat){
        $produits = $this->db->prepare("SELECT * FROM produit WHERE idcategorie ?", array($idCat), Produit::class);
        return $produits;
    }

    /**
     * Récupérer tt les produit
     * @param null $nbr nombre de produit à récupérer
     * @param null $offset décalage
     * @return array
     */
    public function getList($nbr = null, $offset = null){
        $req = "SELECT * FROM produit ORDER BY referencep";
        if (isset($offset) && (ctype_digit($offset) || is_int($offset)) && (ctype_digit($nbr) || is_int($nbr)))
        {
            $req = $req . " LIMIT " . $offset . ", " . $nbr;
        }
        elseif(isset($nbr) && (ctype_digit($nbr) || is_int($nbr)))
        {
            $req = $req . " LIMIT " . $nbr;
        }
        $produits = $this->db->query($req, Produit::class);
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
            ':description' => $produit->getDescription(),
            ':prix' => $produit->getPrix(),
            ':cheminphoto' => $produit->getCheminPhoto(),
            ':etatvente' => $produit->getEtatVente(),
            ':pourcentagereduction' => $produit->getPourcentageReduction(),
            ':lienFB' => $produit->getLienFB()
        );
        $this->db->prepare("INSERT INTO produit 
        (referencep, idcategorie, libelle, description, prix, cheminphoto, etatvente, pourcentagereduction, lienfb)
        VALUES 
        (:referencep, :idcategorie, :libelle, :description, :prix, :cheminphoto, :etatvente, :pourcentagereduction, :lienFB)", $param);
    }
    /**
     * Modifier un produit à la base de donnée
     * @param Produit $produit
     */
    public function update(Produit $produit){
        $param = array(
            ':idProduit' => $produit->getIdProduit(),
            ':referencep' => $produit->getReferenceProduit(),
            ':idcategorie' => $produit->getIdCategorie(),
            ':idcaracteristique' => $produit->getDescription(),
            ':libelle' => $produit->getLibelle(),
            ':prix' => $produit->getPrix(),
            ':cheminphoto' => $produit->getCheminPhoto(),
            ':etatvente' => $produit->getEtatVente(),
            ':pourcentagereduction' => $produit->getPourcentageReduction(),
            ':lienFB' => $produit->getLienFB()
        );
        $this->db->prepare("UPDATE produit SET 
                                  referencep = :referencep,
                                  idcategorie = :idcategorie,
                                  idcaracteristique = :idcaracteristique,
                                  libelle = :libelle,
                                  description = :description,
                                  prix = :prix,
                                  cheminphoto = :cheminphoto,
                                  etatvente = :etatvente,
                                  pourcentagereduction = :pourcentagereduction,
                                  lienfb = :lienFB
                                  WHERE 
                                  idProduit = :idProduit", $param);
    }
    /**
     * Supprimer un produit de la base de donnée
     * @param Produit $produit
     */
    public function delete(Produit $produit){
        $this->db->prepare("DELETE FROM produit WHERE idProduit = ?", array($produit->getIdProduit()));
    }
    /**Modifier un produit s'il existe sinon l'insérer
     * @param Produit $produit
     */
    public function add(Produit $produit){
        if ($this->findById($produit->getIdProduit()))
            $this->update($produit);
        else
            $this->create($produit);
    }
}
