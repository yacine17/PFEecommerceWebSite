<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 17:30
 */

namespace app\table;


use app\classes\Employe;
use app\classes\Personne;

class EmployeTable extends PersonneTable
{
    /**
     * Récupérer un employe a partir de son id
     * @param $id
     * Retourne un Employe s'il existe sinon false
     * @return Employe|false
     */
    public function findByID($id)
    {
        $employe = $this->db->prepare("SELECT * FROM employe
                                                LEFT JOIN personne
                                                ON employe.id = personne.id
                                                WHERE employe.id = ?",
                                                array($id), Employe::class, true);
        return $employe;
    }

    /**
     * Récupérer un employe a partir de son nom
     * @param $name
     * Retourne un employe s'il existe sinon false
     * @return Employe|false
     */
    public function findByName($name)
    {
        $employe = $this->db->prepare("SELECT * FROM employe
                                                LEFT JOIN personne
                                                ON employe.id = personne.id
                                                WHERE nom = ?",
            array($name), Employe::class, true);
        return $employe;
    }

    /**
     * Récupérer tt les employes
     * Retourne tableau des employes s'il au moins un sinon false
     * @return array(Employe)|false
     */
    public function getAll()
    {
        $employes = $this->db->query("SELECT * FROM employe
                                                 LEFT JOIN personne
                                                 ON employe.id = personne.id", Employe::class);
        return $employes;
    }

    public function create(Personne $employe)
    {
        parent::create($employe);
        $param = array(
            ':numemp' => $employe->getNumEmp(),
            ':id' => $employe->getId(),
            ':etatactive' => $employe->getEtatActivite(),
            ':remarque' => $employe->getRemarque()
        );
        $this->db->prepare("INSERT INTO employe VALUES (:numemp, :id, :etatactive, :remarque)", $param);
    }
}