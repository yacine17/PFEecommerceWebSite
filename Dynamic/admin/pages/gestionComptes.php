<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 20/05/2017
 * Time: 20:38
 */
$db = \app\Config::getInstance()->getDatabase();
$empDb = new \app\table\EmployeTable($db);
if (isset($_GET['do']) && $_GET['do'] == 'modifier'){
      if (isset($_POST['valider'])){
          $id = $_POST['idEmploye'];
          $statut = $_POST['statutEmploye'];
          $employe = $empDb->findByID($id);
          $employe->setEtatActivite($statut);
          $empDb->update($employe);
      }
}
elseif(isset($_GET['do']) && $_GET['do'] == 'ajouter'){
    if (isset($_POST['valider'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $motDePasse = $_POST['motDePasse'];
        $motDePasseHaché = password_hash($motDePasse, PASSWORD_DEFAULT);
        $employe = new \app\classes\Employe($nom, $prenom, null, $email, null,
            \app\classes\Employe::ACTIVE);
        $employe->setId($employe->newIdEmploye());
        $compte = new \app\classes\Compte($username, $motDePasseHaché, $employe->getId());
        $empDb->create($employe);
        $compteDb = new \app\table\CompteTable($db);
        $compteDb->create($compte);
        unset($_POST);
    }
}
$employes = $empDb->getAll();
?>
<div class="gestionCompte">
    <div class="container">
        <h1 class="text-center">Gestion des comptes</h1>
        <form>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher un employé" id="rechercherEmploye">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <table class="table tablesorter" id="tableDesEmploye">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach ($employes as $employe)
                {
                    /**
                     * @var $employe \app\classes\Employe
                     */
                    ?>
                    <tr data-id="<?= $employe->getId() ?>" data-target="#detailEmployeModal" data-toggle="modal">
                        <td><?= $employe->getId() ?></td>
                        <td><?= $employe->getNom() ?></td>
                        <td><?= $employe->getPrenom() ?></td>
                        <td><?= $employe->getEmail() ?></td>
                        <td><?php
                            if ($employe->getEtatActivite() == \app\classes\Employe::ACTIVE)
                                echo "Active";
                            elseif ($employe->getEtatActivite() == \app\classes\Employe::NON_ACTIVE)
                                echo "Non active";
                            ?>
                        </td>
                    </tr>
                <?php
                }
            ?>
            </tbody>
        </table>
        <!--Start modal-->
        <div class="modal fade" id="detailEmployeModal" tabindex="-1" role="dialog"
             aria-labelledby="detailEmployeModalLabel">

        </div>
        <!--End Modal-->
        <div class="ajouterNouveauCompte btn btn-primary text-center right-float" title="Ajouter un nouveau employé" data-toggle="modal"
        data-target="#ajouterEmployeModal">
            <i class="fa fa-user-plus fa-2x"></i>
        </div>
        <!--Start modal-->
        <div class="modal fade" id="ajouterEmployeModal" tabindex="-1" role="dialog"
             aria-labelledby="ajouterEmployeModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ajouter un nouveau employé</h4>
                    </div>
                    <form action="?do=ajouter" method="post" class="form-horizontal">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputNom" class="col-sm-3 control-label">Nom :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputNom" placeholder="Nom" name="nom" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPrenom" class="col-sm-3 control-label">Prénom :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputPrenom" placeholder="Prénom" name="prenom" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-3 control-label">Nom d'utilisateur :</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputUsername" placeholder="Nom d'utilisateur" name="username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-3 control-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-sm-3 control-label">Mot de passe :</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="motDePasse" name="motDePasse" required>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" name="valider">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End Modal-->
    </div>
</div>
