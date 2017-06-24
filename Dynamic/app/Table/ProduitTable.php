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
    private function remplirProduit(Produit $produit)
    {
        $stockDb = new StockTable($this->db);
        $stock = $stockDb->findById($produit->getIdProduit());
        $produit->setStock($stock);
        $caraDb = new CaracteristiqueTable($this->db);
        $caracteristiques = $caraDb->findByProduit($produit);
        $produit->setCaracteristiques($caracteristiques);
        return $produit;

    }
    /**
     * Récupérer un produit a partir de son id
     * @param $id
     * @return Produit|false
     */
    public function findById($id){
        $produit = $this->db->prepare("SELECT * FROM produit WHERE idProduit = ?", array($id), Produit::class, true);
        if ($produit)
            $produit = $this->remplirProduit($produit);
        return $produit;
    }


    /**
     * Récupérer un produit a partir de reference
     * @param $reference
     * @return Produit
     */
    public function findByReference($reference){
        $produit = $this->db->prepare("SELECT * FROM produit WHERE referencep = ?", array($reference), Produit::class, true);
        if ($produit)
            $produit = $this->remplirProduit($produit);
        return $produit;
    }
    /**
     * Récupérer un produit a partir de son nom
     * @param $nom
     * @return Produit|false
     */
    public function findByName($nom){
        $produit = $this->db->prepare("SELECT * FROM produit WHERE libelle = ?", array($nom), Produit::class, true);
        if ($produit)
            $produit = $this->remplirProduit($produit);
        return $produit;
    }

    /**
     * Récupérer tt les produits d'une categorie
     * @param $idCat
     * @return array|mixed
     */
    public function getByCategorie($idCat){
        $produits = $this->db->prepare("SELECT * FROM produit WHERE idcategorie = ?", array($idCat), Produit::class);
        $nvProduits = array();
        foreach ($produits as $produit)
        {
            $produit = $this->remplirProduit($produit);
            array_push($nvProduits, $produit);
        }
        return $nvProduits;
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
        $nvProduits = array();
        foreach ($produits as $produit)
        {
            $produit = $this->remplirProduit($produit);
            array_push($nvProduits, $produit);
        }
        return $nvProduits;
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
            ':description' => $produit->getDescription(),
            ':libelle' => $produit->getLibelle(),
            ':prix' => $produit->getPrix(),
            ':cheminphoto' => $produit->getCheminPhoto(),
            ':etatvente' => $produit->getEtatVente(),
            ':pourcentagereduction' => $produit->getPourcentageReduction(),
            ':lienFB' => $produit->getLienFB(),
            ':nombreDeVus'  => $produit->getNombreDeVus(),
            ':nombreDeVente' => $produit->getNombreDeVente()
        );
        $this->db->prepare("UPDATE produit SET 
                                  referencep = :referencep,
                                  idcategorie = :idcategorie,
                                  libelle = :libelle,
                                  description = :description,
                                  prix = :prix,
                                  cheminphoto = :cheminphoto,
                                  etatvente = :etatvente,
                                  pourcentagereduction = :pourcentagereduction,
                                  lienfb = :lienFB,
                                  nombreDeVus = :nombreDeVus,
                                  nombreDeVente = :nombreDeVente
                                  WHERE 
                                  idProduit = :idProduit", $param);
    }
    /**
     * Supprimer un produit de la base de donnée
     * @param Produit $produit
     */
    public function delete(Produit $produit){
        $stockDb = new StockTable($this->db);
        $stockDb->delete($produit->getStock());
        $caraDb = new CaracteristiqueTable($this->db);
        foreach ($produit->getCaracteristiques() as $caracteristique)
            $caraDb->delete($caracteristique);
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

    public function createV2(Produit $produit)
    {
        $this->create($produit);
        $idProduit = $this->db->lastInsertedId();
        $produit->getStock()->setIdProduit($idProduit);
        $stockDb = new StockTable($this->db);
        $stockDb->create($produit->getStock());
        $caraDb = new CaracteristiqueTable($this->db);
        foreach ($produit->getCaracteristiques() as $caracteristique)
        {
            $caracteristique->setIdProduit($idProduit);
            $caraDb->create($caracteristique);
        }

    }

    public function updateV2(Produit $produit)
    {
        $this->update($produit);
        $stockDb = new StockTable($this->db);
        $stockDb->update($produit->getStock());
        $caraDb = new CaracteristiqueTable($this->db);
        foreach ($produit->getCaracteristiques() as $caracteristique)
            $caraDb->update($caracteristique);
    }

    public function addV2(Produit $produit){
        if ($this->findById($produit->getIdProduit()))
            $this->updateV2($produit);
        else
            $this->createV2($produit);
    }

    public function searchBar($motCherche, $prixMin = null, $prixMax = null, $marque = null){
        $param = array(
            ':libelle' => '%' . $motCherche . '%'
            );
        $req = "SELECT * FROM produit WHERE libelle LIKE :libelle";
        if (!empty($prixMin))
        {
            $req = $req . " AND prix >= :prixMin";
            $param[':prixMin'] = $prixMin;
        }
        if (!empty($prixMax))
        {
            $req = $req . " AND prix <= :prixMax";
            $param[':prixMax'] = $prixMax;
        }
        if (!empty($marque))
        {
            $req = $req . " AND marque = :marque";
            $param[':marque'] = $marque;
        }
        $produits = $this->db->prepare($req, $param, Produit::class);
        $nvProduits = array();
        foreach ($produits as $produit)
        {
            $produit = $this->remplirProduit($produit);
            array_push($nvProduits, $produit);
        }
        return $nvProduits;
    }

    public function getAllMarques()
    {
        $marques = $this->db->query("SELECT DISTINCT marque FROM produit");
        return $marques;
    }

    public function plusVus($nbr = null, $offset = null){
        $req = "SELECT * FROM produit ORDER BY nombreDeVus DESC";
        if (isset($offset) && (ctype_digit($offset) || is_int($offset)) && (ctype_digit($nbr) || is_int($nbr)))
        {
            $req = $req . " LIMIT " . $offset . ", " . $nbr;
        }
        elseif(isset($nbr) && (ctype_digit($nbr) || is_int($nbr)))
        {
            $req = $req . " LIMIT " . $nbr;
        }
        $produits = $this->db->prepare($req, null, Produit::class);
        $nvProduits = array();
        foreach ($produits as $produit)
        {
            $produit = $this->remplirProduit($produit);
            array_push($nvProduits, $produit);
        }
        return $nvProduits;
    }

    public function plusVendus($nbr = null, $offset = null){
        $req = "SELECT * FROM produit ORDER BY nombreDeVente DESC";
        if (isset($offset) && (ctype_digit($offset) || is_int($offset)) && (ctype_digit($nbr) || is_int($nbr)))
        {
            $req = $req . " LIMIT " . $offset . ", " . $nbr;
        }
        elseif(isset($nbr) && (ctype_digit($nbr) || is_int($nbr)))
        {
            $req = $req . " LIMIT " . $nbr;
        }
        $produits = $this->db->prepare($req, null, Produit::class);
        $nvProduits = array();
        foreach ($produits as $produit)
        {
            $produit = $this->remplirProduit($produit);
            array_push($nvProduits, $produit);
        }
        return $nvProduits;
    }
}
