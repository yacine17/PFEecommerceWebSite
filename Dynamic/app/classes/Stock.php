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
    private $idProduit;
    private $etat;
    private $qtedispo;
    private $emailfournisseur;
    const DISPONIBLE = 1;
    const NON_DISPONIBLE = 2;

    /**
     * Stock constructor.
     * @param $idProduit
     * @param $etat
     * @param $qtedispo
     * @param $emailfournisseur
     */
    public function __construct($idProduit = null, $etat = null, $qtedispo = null, $emailfournisseur = null)
    {
        if (isset($idProduit))
            $this->idProduit = $idProduit;
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