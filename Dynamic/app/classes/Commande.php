<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 21:40
 */

namespace app\classes;


class Commande
{
    private $numcommande;
    private $id;
    private $date;
    private $adresselivraison;
    private $etatvalidation;

    const EN_COURS_DE_TRAITEMNT  = 1;
    const APPROUVEE = 2;
    const LIVREE = 3;

    /**
     * Commande constructor.
     * @param $numcommande
     * @param $id
     * @param $date
     * @param $adresselivraison
     * @param $etatvalidation
     */
    public function __construct($numcommande = null, $id = null, $date = null, $adresselivraison = null, $etatvalidation = null)
    {
        if (isset($numcommande))
            $this->numcommande = $numcommande;
        if(isset($id))
            $this->id = $id;
        if (isset($date))
            $this->date = $date;
        if (isset($adresselivraison))
            $this->adresselivraison = $adresselivraison;
        if (isset($etatvalidation))
            $this->etatvalidation = $etatvalidation;
    }

    /**
     * @return null
     */
    public function getNumCommande()
    {
        return $this->numcommande;
    }

    /**
     * @param null $numcommande
     */
    public function setNumCommande($numcommande)
    {
        $this->numcommande = $numcommande;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getDateCommande()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDateCommande($date)
    {
        $this->date = $date;
    }

    /**
     * @return null
     */
    public function getAdresseLivraison()
    {
        return $this->adresselivraison;
    }

    /**
     * @param null $adresselivraison
     */
    public function setAdresseLivraison($adresselivraison)
    {
        $this->adresselivraison = $adresselivraison;
    }

    /**
     * @return null
     */
    public function getEtatValidation()
    {
        return $this->etatvalidation;
    }

    /**
     * @param null $etatvalidation
     */
    public function setEtatValidation($etatvalidation)
    {
        $this->etatvalidation = $etatvalidation;
    }


}