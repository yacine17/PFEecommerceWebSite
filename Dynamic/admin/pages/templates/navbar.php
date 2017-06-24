<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 02/04/2017
 * Time: 22:04
 */
?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">LibTech</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientèle <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="commandesClient.php">Commandes client</a></li>
                        <li><a href="factures.php">Factures</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="newsletters.php">Newsletter</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vitrine & stock <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="produits.php">Gestion Produits</a></li>
                        <?php
                        if (\app\classes\Authentification::estAdmin()) {
                            ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="commandesFournisseur.php">Passer commande</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                if (\app\classes\Authentification::estAdmin())
                    echo "<li><a href='comptes.php'>Gestion des comptes</a></li>"
                ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['auth']['username'] ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a data-toggle="modal" data-target="#modifierProfilModal">Modifier compte</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="pages/templates/logout.php">Déconnexion</a> </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?php
$employeDb = new \app\table\EmployeTable(\app\Config::getInstance()->getDatabase());
$employe = $employeDb->findByID($_SESSION['auth']['id']);
if (isset($_POST['modifierProfil']))
{
    if (isset($_POST['nom']))
        $employe->setNom($_POST['nom']);
    if (isset($_POST['prenom']))
        $employe->setPrenom($_POST['prenom']);
    if (isset($_POST['ancienMotDePasse']) && isset($_POST['nvMotDePasse']) &&
        !empty($_POST['ancienMotDePasse']) && !empty($_POST['nvMotDePasse'])
    ) {
        //TODO a refaire avec hash mot de passe
        if ($_POST['ancienMotDePasse'] == $_SESSION['auth']['motDePasse']) ;
        $nvMotDePasse = $_POST['nvMotDePasse'];
        $compteDb = new \app\table\CompteTable(\app\Config::getInstance()->getDatabase());
        $compte = $compteDb->findById($_SESSION['auth']['id']);
        $nvMotDePasse = password_hash($nvMotDePasse, PASSWORD_DEFAULT);
        $compte->setMotDePasse($nvMotDePasse);
        $compteDb->update($compte);
    }
    $employeDb->update($employe);
}
?>
<div class="modal fade" id="modifierProfilModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modifier mon profil</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <label>Nom:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nom" required
                                   value="<?= $employe->getNom()?>">
                        </div>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <label>prenom:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="prenom" required
                                   value="<?= $employe->getPrenom()?>">
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="modifierProfil">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>