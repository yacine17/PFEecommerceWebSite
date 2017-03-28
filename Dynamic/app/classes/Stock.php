<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 26/03/2017
 * Time: 14:37
 */

namespace app\classes;


class Stock
{
    private $refproduit;
    private $idcategorie;
    private $etat;
    private $qtedispo;
    private $emailfournisseur;
    const DISPONIBLE = 1;
    const NON_DISPONIBLE = 2;

    /**
     * Stock constructor.
     * @param $refproduit
     * @param $idcategorie
     * @param $etat
     * @param $qtedispo
     * @param $emailfournisseur
     */
    public function __construct($refproduit = null, $idcategorie = null, $etat = null, $qtedispo = null, $emailfournisseur = null)
    {
        if (isset($refproduit))
            $this->refproduit = $refproduit;
        if (isset($idcategorie))
            $this->idcategorie = $idcategorie;
        if (isset($etat))
            $this->etat = $etat;
        if (isset($qtedispo))
            $this->qtedispo = $qtedispo;
        if (isset($emailfournisseur))
            $this->emailfournisseur = $emailfournisseur;
    }

    /**
     * @return string
     */
    public function getReferenceProduit()
    {
        return $this->refproduit;
    }

    /**
     * @param null $refproduit
     */
    public function setReferenceProduit($refproduit)
    {
        $this->refproduit = $refproduit;
    }

    /**
     * @return string
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
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param null $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return null
     */
    public function getQuantiteDisponible()
    {
        return $this->qtedispo;
    }

    /**
     * @param null $qtedispo
     */
    public function setQuantiteDisponible($qtedispo)
    {
        $this->qtedispo = $qtedispo;
    }

    /**
     * @return null
     */
    public function getEmailFournisseur()
    {
        return $this->emailfournisseur;
    }

    /**
     * @param null $emailfournisseur
     */
    public function setEmailFournisseur($emailfournisseur)
    {
        $this->emailfournisseur = $emailfournisseur;
    }



}