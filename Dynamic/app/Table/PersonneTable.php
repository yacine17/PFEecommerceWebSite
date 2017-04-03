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
        $values = array(
            ':id'        => $personne->getId(),
            ':nom'     => $personne->getNom(),
            ':prenom' => $personne->getPrenom(),
            ':adresse'  => $personne->getAdresse(),
            ':email'    => $personne->getEmail(),
            ':tel'       => $personne->getTel()
        );
        $this->db->prepare("INSERT INTO personne VALUES (:id, :nom, :prenom, :adresse, :email, :tel)", $values);
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
            ':adresse'  => $personne->getAdresse(),
            ':email'    => $personne->getEmail(),
            ':tel'       => $personne->getTel(),
            ':id'        => $personne->getId()
        );
        $this->db->prepare("UPDATE personne
                                SET 
                                nom = :nom,
                                prenom = :prenom,
                                adresse = :adresse,
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

    public function nombreClient(){
        $res=$this->db->query("SELECT count(id) as nbrc FROM Personne WHERE id LIKE 'C%'", null, true);
        return $res->nbrc;
    }
}