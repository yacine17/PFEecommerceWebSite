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
    private $numeroTelephone;
    private $etatvalidation;
    private $produitCommandes = array();
    private $client;

    //Pour l'etat de validation
    const EN_COURS_DE_TRAITEMNT  = 1;
    const APPROUVEE = 2;
    const REFUSEE = 3;

    /**
     * Commande constructor.
     * @param $numcommande
     * @param $id
     * @param $date
     * @param $adresselivraison
     * @param $numeroTelephone
     * @param $etatvalidation
     * @param $produitCommandes
     */
    public function __construct($numcommande = null, $id = null, $date = null, $adresselivraison = null,
                                $numeroTelephone = null, $etatvalidation = null, $produitCommandes = null)
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
        if (isset($produitCommandes ))
            $this->produitCommandes = $produitCommandes;
        if (isset($numeroTelephone))
            $this->numeroTelephone = $numeroTelephone;
    }

    /**
     * @return null
     */
    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    /**
     * @param null $numeroTelephone
     */
    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;
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

    /**
     * @return array
     */
    public function getProduitCommandes()
    {
        return $this->produitCommandes;
    }

    /**
     * @param array $produitCommandes
     */
    public function setProduitCommandes($produitCommandes)
    {
        $this->produitCommandes = $produitCommandes;
    }

    public function ajouterProduitCommande(ProduitCommande $produitCommande)
    {
        $this->produitCommandes[] = $produitCommande;
    }

    /**
     * @return Personne
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Personne $client
     */
    public function setClient(Personne $client)
    {
        $this->client = $client;
    }

    public function PrixTTC()
    {
        $prix = 0;
        foreach ($this->produitCommandes as $produit)
        {
            /**
             * @var $produit ProduitCommande
             */
            $prix = $prix + $produit->getProduit()->getPrix() * $produit->getQuantite();
        }
        return $prix;
    }
}