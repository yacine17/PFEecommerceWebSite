<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 22:50
 */

namespace app\classes;


class ProduitCommande
{
    private $idProduit;
    private $idcmd;
    private $qte;

    /**
     * ProduitCommande constructor.
     * @param $idProduit
     * @param $idcmd
     * @param $qte
     */
    public function __construct($idProduit = null, $idcmd = null, $qte = null)
    {
        if (isset($idProduit))
            $this->idProduit = $idProduit;
        if (isset($idcmd))
            $this->idcmd = $idcmd;
        if (isset($qte))
            $this->qte = $qte;
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
    public function getIdCommande()
    {
        return $this->idcmd;
    }

    /**
     * @param null $idcmd
     */
    public function setIdCommande($idcmd)
    {
        $this->idcmd = $idcmd;
    }

    /**
     * @return null
     */
    public function getQuantite()
    {
        return $this->qte;
    }

    /**
     * @param null $qte
     */
    public function setQuantite($qte)
    {
        $this->qte = $qte;
    }



}