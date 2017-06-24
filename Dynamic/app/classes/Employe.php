<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 17:30
 */

namespace app\classes;

use app\Config;
use app\table\PersonneTable;

class Employe extends Personne
{
    protected $id;
    protected $etatactivite;

    const ACTIVE = 1;
    const NON_ACTIVE = 0;
    /**
     * Employe constructor.
     * @param null $nom
     * @param null $prenom
     * @param null $adresse
     * @param null $email
     * @param null $tel
     * @param null $etatactivite
     * @param null $id
     */
    public function __construct($nom = null, $prenom = null, $adresse = null, $email = null, $tel = null,
                                $etatactivite = null, $id = null)
    {
        parent::__construct($nom, $prenom, $adresse, $email, $tel, $id);
        if (isset($etatactivite))
            $this->etatactivite = $etatactivite;
        if (isset($id))
            $this->id = $id;
    }
    public function newIdEmploye(){
    $ptable = new PersonneTable(Config::getInstance()->getDatabase());
    $dernierId = $ptable->lastEmployeId();
    $dernierId = substr($dernierId, 1);
    $nvId = intval($dernierId) + 1;
    return 'e' . $nvId;
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
}