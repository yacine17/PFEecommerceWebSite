<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 10/05/2017
 * Time: 11:46
 */
if (\app\classes\Authentification::estConnecte()) {
    $db = \app\Config::getInstance()->getDatabase();
    $perDb = new \app\table\PersonneTable($db);
    $client = $perDb->findByID($_SESSION['auth']['id']);
    if (isset($_POST['submitModification'])) {
        if (isset($_POST['nom']) && !empty($_POST['nom'])) {
            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
            $client->setNom($nom);
        }
        if (isset($_POST['prenom']) && !empty($_POST['prenom'])) {
            $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
            $client->setPrenom($prenom);
        }
        if (isset($_POST['ancienMotDePasse']) && isset($_POST['nvMotDePasse']) &&
            !empty($_POST['ancienMotDePasse']) && !empty($_POST['nvMotDePasse'])
        ) {
            //TODO a refaire avec hash mot de passe
            if ($_POST['ancienMotDePasse'] == $_SESSION['auth']['motDePasse']) ;
            $nvMotDePasse = $_POST['nvMotDePasse'];
            $compteDb = new \app\table\CompteTable($db);
            $compte = $compteDb->findById($_SESSION['auth']['id']);
            $nvMotDePasse = password_hash($nvMotDePasse, PASSWORD_DEFAULT);
            $compte->setMotDePasse($nvMotDePasse);
            $compteDb->update($compte);
        }
        $perDb->update($client);
    }
    ?>
    <div class="login">
        <div class="modal fade" id="modifierProfilModal" tabindex="-1" role="dialog"
             aria-labelledby="modifierProfilModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <div class="sign-in">
                            <h2 class="h1 text-center">Modifier Profil</h2>
                            <form role="form" method="post" action="">
                                <div class="col-md-6 col-md-offset-3">
                                    <label>Nom:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nom" required
                                               value="<?= $client->getNom() ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <label>prenom:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="prenom" required
                                               value="<?= $client->getPrenom() ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <label>Ancien Mot de passe:</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="ancienMotDePasse">
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <label>Nouveau Mot de passe:</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="nvMotDePasse">
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-block" value="Sauvegarder"
                                               name="submitModification">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}