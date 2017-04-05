<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 05/04/2017
 * Time: 15:13
 */

namespace app\classes;


use app\Config;
use app\table\CompteTable;

class Authentification
{
    public static function estConnecte(){
        $compteTable = new CompteTable(Config::getInstance()->getDatabase());
        $compte = $compteTable->findByName($_SESSION['auth']['username']);
        if (!empty($compte))
        {
            if (password_verify($_SESSION['auth']['motDePasse'], $compte->getMotDePasse()))
                return true;
            else
                return false;
        } else
        {
            return false;
        }
    }
}