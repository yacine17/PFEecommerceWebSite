<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 17:30
 */

namespace app\classes;


class Employe extends Personne
{
    protected $numemp;
    protected $etatactivite;
    protected $remarque;

    /**
     * Employe constructor.
     * @param null $nom
     * @param null $prenom
     * @param null $adresse
     * @param null $email
     * @param null $tel
     * @param null $etatactivite
     * @param null $remarque
     * @param null $id
     * @param null $numemp
     */
    public function __construct($nom = null, $prenom = null, $adresse = null, $email = null, $tel = null,
                                $etatactivite = null, $remarque = null, $id = null, $numemp = null)
    {
        parent::__construct($nom, $prenom, $adresse, $email, $tel, $id);
        if (isset($numemp))
            $this->numemp = $numemp;
        if (isset($etatactivite))
            $this->etatactivite = $etatactivite;
        if (isset($remarque))
            $this->remarque = $remarque;
    }

    /**
     * @return null
     */
    public function getNumEmp()
    {
        return $this->numemp;
    }

    /**
     * @param null $numemp
     */
    public function setNumEmp($numemp)
    {
        $this->numemp = $numemp;
    }

    /**
     * @return null
     */
    public function getEtatActivite()
    {
        return $this->etatactivite;
    }

    /**
     * @param null $etatactivite
     */
    public function setEtatActivite($etatactivite)
    {
        $this->etatactivite = $etatactivite;
    }

    /**
     * @return null
     */
    public function getRemarque()
    {
        return $this->remarque;
    }

    /**
     * @param null $remarque
     */
    public function setRemarque($remarque)
    {
        $this->remarque = $remarque;
    }


}