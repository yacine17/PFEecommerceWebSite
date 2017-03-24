<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 15:07
 */

namespace app\classes;


class Compte
{
    private $id;
    private $login;
    private $motdepasse;

    /**
     * Compte constructor.
     * @param null $login
     * @param null $motdepasse
     * @param null $id
     */
    public function __construct($login = null, $motdepasse = null, $id = null)
    {
        if (isset($id))
            $this->id = $id;
        if (isset($login))
            $this->login = $login;
        if (isset($motdepasse))
            $this->motdepasse = $motdepasse;
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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param null $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return null
     */
    public function getMotDePasse()
    {
        return $this->motdepasse;
    }

    /**
     * @param null $motdepasse
     */
    public function setMotDePasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
    }

}