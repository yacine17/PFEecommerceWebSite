<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 26/03/2017
 * Time: 16:14
 */

namespace app\classes;


class Facture
{
    private $numfacture;
    private $numcommande;
    private $valeurcommande;
    private $taxe;
    private $prixttc;
    private $date;
    private $etatpaiement;
    private $etatlivraison;
    private $numemploye;

    //Pour l'état de paiment
    const REGLEE = 1;
    const NON_REGLEE = 2;

    //Pour l' état de livraison
    const LIVREE = 1;
    const NON_LIVREE = 2;

    /**
     * Facture constructor.
     * @param $numfacture
     * @param $numcommande
     * @param $valeurcommande
     * @param $taxe
     * @param $prixttc
     * @param $date
     * @param $etatpaiment
     * @param $etatlivraison
     * @param $numemploye
     */
    public function __construct($numfacture = null, $numcommande = null, $valeurcommande = null, $taxe = null
        , $prixttc = null, $date = null, $etatpaiement = null, $etatlivraison = null, $numemploye = null)
    {
        if (isset($numfacture))
            $this->numfacture = $numfacture;
        if (isset($numcommande))
            $this->numcommande = $numcommande;
        if (isset($valeurcommande))
            $this->valeurcommande = $valeurcommande;
        if (isset($taxe))
            $this->taxe = $taxe;
        if (isset($prixttc))
            $this->prixttc = $prixttc;
        if (isset($date))
            $this->date = $date;
        if (isset($etatpaiement))
            $this->etatpaiement = $etatpaiement;
        if (isset($etatlivraison))
            $this->etatlivraison = $etatlivraison;
        if (isset($numemploye))
            $this->numemploye = $numemploye;
    }

    /**
     * @return null
     */
    public function getNumeroFacture()
    {
        return $this->numfacture;
    }

    /**
     * @param null $numfacture
     */
    public function setNumemroFacture($numfacture)
    {
        $this->numfacture = $numfacture;
    }

    /**
     * @return null
     */
    public function getNumeroCommande()
    {
        return $this->numcommande;
    }

    /**
     * @param null $numcommande
     */
    public function setNumeroCommande($numcommande)
    {
        $this->numcommande = $numcommande;
    }

    /**
     * @return null
     */
    public function getValeurCommande()
    {
        return $this->valeurcommande;
    }

    /**
     * @param null $valeurcommande
     */
    public function setValeurCommande($valeurcommande)
    {
        $this->valeurcommande = $valeurcommande;
    }

    /**
     * @return null
     */
    public function getTaxe()
    {
        return $this->taxe;
    }

    /**
     * @param null $taxe
     */
    public function setTaxe($taxe)
    {
        $this->taxe = $taxe;
    }

    /**
     * @return null
     */
    public function getPrixTtc()
    {
        return $this->prixttc;
    }

    /**
     * @param null $prixttc
     */
    public function setPrixTtc($prixttc)
    {
        $this->prixttc = $prixttc;
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
    public function getEtatPaiement()
    {
        return $this->etatpaiement;
    }

    /**
     * @param null $etatpaiment
     */
    public function setEtatPaiement($etatpaiment)
    {
        $this->etatpaiement = $etatpaiment;
    }

    /**
     * @return null
     */
    public function getEtatLivraison()
    {
        return $this->etatlivraison;
    }

    /**
     * @param null $etatlivraison
     */
    public function setEtatLivraison($etatlivraison)
    {
        $this->etatlivraison = $etatlivraison;
    }

    /**
     * @return null
     */
    public function getNumeroEmploye()
    {
        return $this->numemploye;
    }

    /**
     * @param null $numemploye
     */
    public function setNumeroEmploye($numemploye)
    {
        $this->numemploye = $numemploye;
    }


}