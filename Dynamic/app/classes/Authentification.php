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
        if (isset($_SESSION['auth']) && isset($_SESSION['auth']['username']) && isset($_SESSION['auth']['motDePasse']))
        {
            $compteTable = new CompteTable(Config::getInstance()->getDatabase());
            $compte = $compteTable->findByName($_SESSION['auth']['username']);
            if (!empty($compte))
            {
                if (password_verify($_SESSION['auth']['motDePasse'], $compte->getMotDePasse()))
                {
                    $_SESSION['auth']['id'] = $compte->getId();
                    return true;
                }
            }
        }
            return false;
    }

    public static function estEmploye(){
        if (isset($_SESSION['auth']) && isset($_SESSION['auth']['id']))
            if (strpos($_SESSION['auth']['id'], 'e') === 0)
                return true;
            else
                return false;
    }

}