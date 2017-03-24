<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 23:33
 */

namespace app\classes;


class Personne extends \stdClass
{
    protected $id;
    protected $nom;
    protected $prenom;
    protected $adresse;
    protected $email;
    protected $tel;

    /**
     * Personne constructor.
     * @param $nom
     * @param $prenom
     * @param $adresse
     * @param $email
     * @param $tel
     * @param $id
     */
    public function __construct($nom = null, $prenom = null, $adresse = null, $email = null, $tel = null, $id = null)
    {
        if (isset($id))
            $this->id = $id;
        if (isset($nom))
            $this->nom = $nom;
        if (isset($prenom))
            $this->prenom = $prenom;
        if (isset($adresse))
            $this->adresse = $adresse;
        if (isset($email))
            $this->email = $email;
        if (isset($tel))
            $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }



}