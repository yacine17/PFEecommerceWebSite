<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 25/03/2017
 * Time: 19:58
 */

namespace app\classes;


class Caracteristique
{
    private $idcaracteristique;
    private $referencep;
    private $nom;
    private $caractere;

    /**
     * Caracteristique constructor.
     * @param $idcaracteristique
     * @param $referencep
     * @param $nom
     * @param $caractere
     */
    public function __construct($idcaracteristique = null, $referencep = null, $nom = null, $caractere = null)
    {
        if (isset($idcaracteristique))
            $this->idcaracteristique = $idcaracteristique;
        if (isset($referencep))
            $this->referencep = $referencep;
        if (isset($nom))
            $this->nom = $nom;
        if (isset($caractere))
           $this->caractere = $caractere;
    }

    /**
     * @return string
     */
    public function getIdCaracteristique()
    {
        return $this->idcaracteristique;
    }

    /**
     * @param null $idcaracteristique
     */
    public function setIdCaracteristique($idcaracteristique)
    {
        $this->idcaracteristique = $idcaracteristique;
    }

    /**
     * @return null
     */
    public function getReferenceProduit()
    {
        return $this->referencep;
    }

    /**
     * @param null $referencep
     */
    public function setReferenceProduit($referencep)
    {
        $this->referencep = $referencep;
    }

    /**
     * @return null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param null $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return null
     */
    public function getCaractere()
    {
        return $this->caractere;
    }

    /**
     * @param null $caractere
     */
    public function setCaractere($caractere)
    {
        $this->caractere = $caractere;
    }


}