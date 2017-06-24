<?php

/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:48
 */
namespace app\table;
use app\classes\Personne;
class PersonneTable extends Table
{
    /**
     * récupérer une personne a partir de son id
     * @param $id
     * @return Personne
     */
    public function findByID($id){
        $personne = $this->db->prepare("SELECT * FROM personne WHERE id = ?", array($id), Personne::class, true);
        return $personne;
    }

    /**
     * récupérer une personne a partir de son nom
     * @param $name
     * @return Personne
     */
    public function findByName($name)
    {
        $personne = $this->db->prepare("SELECT * FROM personne WHERE nom = ? ", array($name), Personne::class, true);
        return $personne;
    }

    /**
     * récupérer tt les données de la table personne
     * @return array
     */
    public function getAll(){
        $persos = [];
        $persos = $this->db->query('SELECT * FROM personne', Personne::class);
        return $persos;
    }

    /**
     * Insérer une nouvelle personne à la base de donnée
     * @param Personne $personne
     */
    public  function create(Personne $personne)
    {
        if (empty($personne->getId()))
            $personne->setId($personne->newIdClient());
        $values = array(
            ':id'        => $personne->getId(),
            ':nom'     => $personne->getNom(),
            ':prenom' => $personne->getPrenom(),
            ':email'    => $personne->getEmail(),
            ':tel'       => $personne->getTel()
        );
        $this->db->prepare("INSERT INTO personne VALUES (:id, :nom, :prenom, :email, :tel)", $values);
    }

    /**
     * modifier une ligne à la base de donnée
     * @param Personne $personne
     */
    public function update(Personne $personne)
    {
        $param = array(
            ':nom'      => $personne->getNom(),
            ':prenom'  => $personne->getPrenom(),
            ':email'    => $personne->getEmail(),
            ':tel'       => $personne->getTel(),
            ':id'        => $personne->getId()
        );
        $this->db->prepare("UPDATE personne
                                SET 
                                nom = :nom,
                                prenom = :prenom,
                                email = :email, 
                                tel = :tel
                                WHERE id = :id",
                                $param);
    }

    /**
     * Supprimer une personne de la base de donnée
     * @param Personne $personne
     */
    public  function delete(Personne $personne)
    {
        $this->db->prepare("DELETE FROM personne WHERE id = ?", array($personne->getId()));
    }

    /**
     * Récupérer le dernier ID client
     * @return mixed
     */
    public function lastClientId(){
        $res=$this->db->query("SELECT id FROM Personne WHERE id LIKE 'C%' ORDER BY id DESC LIMIT 1", null, true);
        if (!empty($res))
            return $res->id;
        else
            return 'c0';
    }
    public function lastEmployeId(){
        $res=$this->db->query("SELECT id FROM Personne WHERE id LIKE 'E%' ORDER BY id DESC LIMIT 1", null, true);
        if (!empty($res))
            return $res->id;
        else
            return 'e0';
    }
}