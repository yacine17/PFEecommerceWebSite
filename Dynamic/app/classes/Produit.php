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
    private $referencep;
    private $idcategorie;
    private $idcaracteristique;
    private $libelle;
    private $prix;
    private $cheminphoto;
    private $etatvente;
    private $pourcentagereduction;
    private $lienFB;

    /**
     * Produit constructor.
     * @param $referencep
     * @param $idcategorie
     * @param $libelle
     * @param $prix
     * @param $cheminphoto
     * @param $etatvente
     * @param $pourcentagereduction
     */
    public function __construct($referencep = null, $idcategorie = null, $libelle = null,
                                $prix = null, $cheminphoto = null, $etatvente = null, $pourcentagereduction = null,$lienFB=null)
    {
        if (isset($referencep))
            $this->referencep = $referencep;
        if (isset($idcategorie))
            $this->idcategorie = $idcategorie;
        if (isset($idcaracteristique))
            $this->idcaracteristique = $idcaracteristique;
        if (isset($libelle))
            $this->libelle = $libelle;
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



}