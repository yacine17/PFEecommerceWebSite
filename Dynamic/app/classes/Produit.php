<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 17:54
 */

namespace app\classes;


class Produit
{
    private $idProduit;
    private $referencep;
    private $idcategorie;
    private $libelle;
    private $description;
    private $marque;
    private $prix;
    private $cheminphoto;
    private $etatvente;
    private $pourcentagereduction;
    private $lienFB;
    private $nombreDeVus;
    private $nombreDeVente;
    private $stock;
    private $caracteristiques;

    const SANS_PROMOTION = 1;
    const EN_PROMOTION = 2;

    /**
     * Produit constructor.
     * @param $referencep
     * @param $idcategorie
     * @param $libelle
     * @param $description
     * @param $prix
     * @param $cheminphoto
     * @param $etatvente
     * @param $pourcentagereduction
     * @param $lienFB
     * @param $idProduit
     * @param $marque;
     */
    public function __construct($referencep = null, $idcategorie = null, $libelle = null, $description = null,
                                $prix = null, $cheminphoto = null, $etatvente = null,
                                $pourcentagereduction = null, $lienFB=null, $idProduit = null, $marque = null)
    {
        if (isset($referencep))
            $this->referencep = $referencep;
        if (isset($idcategorie))
            $this->idcategorie = $idcategorie;
        if (isset($idcaracteristique))
            $this->idcaracteristique = $idcaracteristique;
        if (isset($libelle))
            $this->libelle = $libelle;
        if (isset($description))
            $this->description = $description;
        if (isset($prix))
            $this->prix = $prix;
        if (isset($cheminphoto))
            $this->cheminphoto = $cheminphoto;
        if (isset($etatvente))
            $this->etatvente = $etatvente;
        if (isset($pourcentagereduction))
            $this->pourcentagereduction = $pourcentagereduction;
        if (isset($lienFB))
            $this->lienFB = $lienFB;
        if (isset($idProduit))
            $this->idProduit = $idProduit;
        if (isset($marque))
            $this->marque = $marque;
        $this->stock = new Stock();
        $this->caracteristiques = array();
    }

    /**
     * @return mixed
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return mixed
     */
    public function getReferenceProduit()
    {
        return $this->referencep;
    }

    /**
     * @param mixed $referencep
     */
    public function setReferenceProduit($referencep)
    {
        $this->referencep = $referencep;
    }

    /**
     * @return mixed
     */
    public function getIdCategorie()
    {
        return $this->idcategorie;
    }

    /**
     * @param mixed $idcategorie
     */
    public function setIdCategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return null
     */
     public function getDescription()
     {
         return $this->description;
     }

    /**
     * @param $description
     */
     public function setDescription($description)
     {
         $this->description = $description;
     }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getCheminPhoto()
    {
        return $this->cheminphoto;
    }

    /**
     * @param mixed $cheminphoto
     */
    public function setCheminPhoto($cheminphoto)
    {
        $this->cheminphoto = $cheminphoto;
    }

    /**
     * @return mixed
     */
    public function getEtatVente()
    {
        return $this->etatvente;
    }

    /**
     * @param mixed $etatvente
     */
    public function setEtatVente($etatvente)
    {
        $this->etatvente = $etatvente;
    }

    /**
     * @return mixed
     */
    public function getPourcentageReduction()
    {
        return $this->pourcentagereduction;
    }

    /**
     * @param mixed $pourcentagereduction
     */
    public function setPourcentageReduction($pourcentagereduction)
    {
        $this->pourcentagereduction = $pourcentagereduction;
    }

    /**
     * @return null
     */
    public function getLienFB()
    {
        return $this->lienFB;
    }

    /**
     * @param null $lienFB
     */
    public function setLienFB($lienFB)
    {
        $this->lienFB = $lienFB;
    }

    /**
     * @param $marque
     */
    public function setMaruqe($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @return mixed
     */
    public function getNombreDeVus()
    {
        if ($this->nombreDeVus == null)
            return 0;

        return intval($this->nombreDeVus);
    }

    /**
     * @param mixed $nombreDeVus
     */
    public function setNombreDeVus($nombreDeVus)
    {
        $this->nombreDeVus = $nombreDeVus;
    }

    /**
     * @return mixed
     */
    public function getNombreDeVente()
    {
        if ($this->nombreDeVente == null)
            return 0;

        return intval($this->nombreDeVente);
    }

    /**
     * @param mixed $nombreDeVente
     */
    public function setNombreDeVente($nombreDeVente)
    {
        $this->nombreDeVente = $nombreDeVente;
    }

    /**
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock(Stock $stock)
    {
        $this->stock = $stock;
        $this->stock->setIdProduit($this->idProduit);
    }

    /**
     * @return Caracteristique[]
     */
    public function getCaracteristiques()
    {
        return $this->caracteristiques;
    }

    /**
     * @param Caracteristique[] $caracteristiques
     */
    public function setCaracteristiques($caracteristiques)
    {
        $this->caracteristiques = $caracteristiques;
    }

    /**
     * @param Caracteristique $caracteristique
     */
    public function ajouterUnCaracteristique(Caracteristique $caracteristique)
    {
        $exist = false;
        if (!empty($this->getCaracteristiques()))
        {
            for ($i = 0; $i < count($this->getCaracteristiques()); $i++)
            {
                if (strtolower($this->getCaracteristiques()[$i]->getNom()) == strtolower($caracteristique->getNom()))
                {
                    $exist = true;
                    $this->caracteristiques[$i] = $caracteristique;
                }
            }
        }
        if (!$exist)
            array_push($this->caracteristiques, $caracteristique);
    }




}