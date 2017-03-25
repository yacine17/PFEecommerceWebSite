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
    private $refproduit;
    private $idcmd;
    private $qte;

    /**
     * ProduitCommande constructor.
     * @param $refproduit
     * @param $idcmd
     * @param $qte
     */
    public function __construct($refproduit = null, $idcmd = null, $qte = null)
    {
        if (isset($refproduit))
            $this->refproduit = $refproduit;
        if (isset($idcmd))
            $this->idcmd = $idcmd;
        if (isset($qte))
            $this->qte = $qte;
    }

    /**
     * @return null
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