<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 24/03/2017
 * Time: 15:03
 */

namespace app\table;


use app\classes\Compte;

class CompteTable extends Table
{
    /**
     * Récupérer un compte a partir de son id
     * Rertourne un compte s'il existe sinon flase
     * @param $id
     * @return Compte
     */
    public function findById($id){
        $compte = $this->db->prepare("SELECT * FROM compte WHERE id = ?", array($id), Compte::class, true);
        return $compte;
    }

    /**
     * Récupérer un compte a partir d son login
     * retourne un compte s'il existe sinon false
     * @param $name
     * @return Compte
     */
    public function findByName($name){
        $compte = $this->db->prepare("SELECT * FROM compte WHERE  login = ?", array($name), Compte::class, true);
        return $compte;
    }

    /**
     *  Récupérer tt les comptes
     * Retourne tableau des comptes s'il ya des comptes sinon False
     * @return array(Compte)
     */
    public function getAll(){
        $comptes = $this->db->query("SELECT * FROM compte", Compte::class);
        return $comptes;
    }

    /**
     * Insérer un nouveau compte à la base de donnée
     * @param Compte $compte
     */
    public function create(Compte $compte){
        $param = array(
            ':id' => $compte->getId(),
            ':login' => $compte->getLogin(),
            ':motdepasse' => $compte->getMotDePasse()
        );
        $this->db->prepare("INSERT INTO compte VALUES (:id, :login, :motdepasse)", $param);
    }

    /**
     * Modifier une ligne à la base de donnée
     * @param Compte $compte
     */
    public function update(Compte $compte){
        $param = array(
            ':id' => $compte->getId(),
            ':login' => $compte->getLogin(),
            ':motdepasse' => $compte->getMotDePasse()
        );
        $this->db->prepare("UPDATE compte SET
                                  login = :login, 
                                  motdepasse = :motdepasse
                                  WHERE id = :id", $param);
    }

    /**
* Supprimer un compte de la base de donnée
* @param Compte $compte
*/
    public function delete(Compte $compte){
        $this->db->prepare("DELETE FROM compte WHERE id = ?", array($compte->getId()));
    }
}