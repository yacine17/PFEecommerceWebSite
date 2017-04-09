<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 22:19
 */

namespace app\classes;


class Categorie
{
    private $idcategorie;
    private $nom;
    private $catprincipale;
    private $nbrproduit;

    /**
     * Categorie constructor.
     * @param null $nom
     * @param null $CatPrincipale
     * @param null $idCategorie
     */
    public function __construct($nom = null, $CatPrincipale = null, $idCategorie = null,$nbrproduit=null)
    {
        if (isset($nom))
            $this->nom = $nom;
        if (isset($CatPrincipale))
            $this->catprincipale = $CatPrincipale;
        if (isset($idCategorie))
            $this->idcategorie = $idCategorie;
        if (isset($nbrproduit))
            $this->nbrproduit=$nbrproduit;
    }

    /**
     * @return null
     */
    public function getIdCategorie()
    {
        return $this->idcategorie;
    }

    /**
     * @param null $idcategorie
     */
    public function setIdCategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    /**
     * @return null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param null $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return null
     */
    public function getCategoriePrincipale()
    {
        return $this->catprincipale;
    }

    /**
     * @param null $catprincipale
     */
    public function setCategoriePrincipale($catprincipale)
    {
        $this->catprincipale = $catprincipale;
    }

    /**
     * @return mixed
     */
    public function getNbrProduit()
    {
        return $this->nbrproduit;
    }

    /**
     * @param mixed $ndrprduit
     */
    public function setNbrProduit($nbrproduit)
    {
        $this->nbrproduit = $nbrproduit;
    }



}