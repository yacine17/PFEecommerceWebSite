<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:19
 */
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $db=\app\Config::getInstance()->getDatabase();
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $name = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['motDePasse'];
        $id = "C";
        $person1 = new \app\classes\Personne($nom, $prenom, null, $email);
        $persondb = new \app\table\PersonneTable($db);
        $persondb->create($person1);
        $cpt = new \app\classes\Compte($name, $pass, $person1->getId());
        $cptTable = new \app\table\CompteTable($db);
        $cptTable->create($cpt);
    }
}
?>
<div class="wrapper-container">
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 login-popup">
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle-o fa-stack-2x"></i>
                <i class="fa fa-close fa-stack-1x white"></i>
            </span>
                <div class="sign-in">
                    <h2 class="h1 text-center">Se connecter</h2>
                    <form role="form">
                        <div class="col-md-6 col-md-offset-3">
                            <label>Nom d'utilisateur:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" required>
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
                                <input type="submit" class="btn btn-block" value="Se connecter">
                            </div>
                        </div>
                    </form>
                    <div class="col-md-6 col-md-offset-3 text-center">
                        <a>Vous n'avez pas encore de compte</a>
                    </div>
                </div>
                <div class="sign-up">
                    <h2 class="h1 text-center">Créer un compte</h2>
                    <form role="form" method="post" action="">
                        <div class="col-md-6 col-md-offset-3">
                            <label>Nom:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="nom" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <label>Prenom:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="prenom" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <label>Nom d'utilisateur:</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" required>
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
                                <input type="password" class="form-control" name="motDePasse" required>
                                <i class="show-pass fa fa-eye fa-2x"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group">
                                <input type="submit" class="btn btn-block" value="S'inscrire">
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
