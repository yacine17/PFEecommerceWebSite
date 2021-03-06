<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:19
 */
use app\classes\Authentification;
use app\classes\Compte;
use app\classes\Personne;
use app\Config;
use app\table\CompteTable;
use app\table\PersonneTable;
@ session_start();
//Tester si l'utilisateur vient d'une requete HTTP POST
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_GET['op']) && $_GET['op'] == 'connexion')
    {
        if (!empty($_POST['username']) && !empty($_POST['motDePasse']))
        {
            $_SESSION['auth'] = array(
                    'username' => $_POST['username'],
                    'motDePasse' => $_POST['motDePasse']
            );

            if (Authentification::estConnecte()){
                //Connecté
               header('location: '. $_SERVER['HTTP_REFERER']);
            }
            else{
                session_reset();
                header('500 Internal Server Error', true, 500);
            }
        }
        else
        {
         //TODO erreur champs non remplis
        }
    }
    elseif (isset($_GET['op']) && $_GET['op'] == 'inscription')
    {
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $motDePasse=$_POST['motDePasse'];
        if (!empty($nom) && !empty($prenom) && !empty($username) && !empty($email) && !empty($motDePasse))
        {
            $compteDb = new CompteTable(Config::getInstance()->getDatabase());
            if (empty($compteDb->findByName($username))) // username n'existe pas a la base de donnée
            {
                $hash = password_hash($motDePasse, PASSWORD_DEFAULT);
                $person = new Personne($nom, $prenom, null, $email);
                $personDb = new PersonneTable(Config::getInstance()->getDatabase());
                $personDb->create($person);
                $compte = new Compte($username, $hash, $person->getId());
                $compteDb->create($compte);
            }
            else
            {
                header('500 Internal Server Error', true, 500);
                echo "Nom d'utilisateur existe déja";
            }
        }
        else
        {
            header('500 Internal Server Error', true, 500);
        }
    }
}
?>
<div class="login">
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="sign-in">
                        <h2 class="h1 text-center">Se connecter</h2>
                        <form role="form" method="post" action="?op=connexion" id="seConnecter">
                            <div class="col-md-6 col-md-offset-3">
                                <label>Nom d'utilisateur:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username"  required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Mot de passe:</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="motDePasse" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block">
                                        Se connecter
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <a>Vous n'avez pas encore un compte</a>
                        </div>
                    </div>
                    <div class="sign-up">
                        <h2 class="h1 text-center">Créer un compte</h2>
                        <form role="form" method="post" action="?op=inscription" id="sInscrire">
                            <div class="col-md-6 col-md-offset-3">
                                <label>Nom:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nom" maxlength="20" ">
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Prenom:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="prenom" required maxlength="20">
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Nom d'utilisateur:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" required pattern="^[a-zA-Z0-9_-]{4,20}$">
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Email:</label>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Mot de passe:</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="motDePasse" required pattern=".{8, 32}">
                                    <i class="show-pass fa fa-eye fa-2x"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block">S'inscrire</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <a>Vous avez déjà un compte</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
