<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/05/2017
 * Time: 20:44
 */

namespace app\classes;


class CommandeFournisseur
{
    private $NumC;
    private $idEmploye;
    private $idProduit;
    private $date;
    private $qte;
    private $etatvalidation;
    private $produit;
    private $employe;

    const VALIDEE = 2;
    const EN_COURS_DE_TRAITEMENT = 1;
    const ANNULEE = 3;

    /**
     * CommandeFournisseur constructor.
     * @param $NumC
     * @param $idEmploye
     * @param $idProduit
     * @param $date
     * @param $qte
     * @param $etatvalidation
     */
    public function __construct($NumC = null, $idEmploye = null, $idProduit = null, $date = null, $qte = null,
                                $etatvalidation = null)
    {
        if (isset($NumC))
            $this->NumC = $NumC;
        if (isset($idEmploye))
            $this->idEmploye = $idEmploye;
        if (isset($idProduit))
            $this->idProduit = $idProduit;
        if (isset($date))
            $this->date = $date;
        if (isset($qte))
            $this->qte = $qte;
        if (isset($etatvalidation))
            $this->etatvalidation = $etatvalidation;
    }

    /**
     * @return null
     */
    public function getNumC()
    {
        return $this->NumC;
    }

    /**
     * @param null $NumC
     */
    public function setNumC($NumC)
    {
        $this->NumC = $NumC;
    }

    /**
     * @return null
     */
    public function getIdEmploye()
    {
        return $this->idEmploye;
    }

    /**
     * @param null $idEmploye
     */
    public function setIdEmploye($idEmploye)
    {
        $this->idEmploye = $idEmploye;
    }

    /**
     * @return null
     */
    public function getIdProduit()
    {
        return $this->idProduit;
    }

    /**
     * @param null $idProduit
     */
    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return null
     */
    public function getQte()
    {
        return $this->qte;
    }

    /**
     * @param null $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }

    /**
     * @return null
     */
    public function getEtatvalidation()
    {
        return $this->etatvalidation;
    }

    /**
     * @param null $etatvalidation
     */
    public function setEtatvalidation($etatvalidation)
    {
        $this->etatvalidation = $etatvalidation;
    }

    /**
     * @return Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param Produit $produit
     */
    public function setProduit(Produit $produit)
    {
        $this->produit = $produit;
    }

    /**
     * @return Employe
     */
    public function getEmploye()
    {
        return $this->employe;
    }

    /**
     * @param Employe $employe
     */
    public function setEmploye(Employe $employe)
    {
        $this->employe = $employe;
    }



}