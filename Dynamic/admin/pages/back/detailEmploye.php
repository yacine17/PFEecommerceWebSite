<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 20/05/2017
 * Time: 21:05
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        require '../../../app/Autoloader.php';
        app\Autoloader::register();
        $empDb = new \app\table\EmployeTable(\app\Config::getInstance()->getDatabase());
        $employe = $empDb->findByID($_GET['id']);
        if ($employe) {
            ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><?= $employe->getNom() . " " . $employe->getPrenom() ?></h4>
                    </div>
                    <form action="?do=modifier" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="idEmploye" value="<?= $employe->getId() ?>">
                            <div class="form-group">
                                <label>Statut d'employé</label>
                                <div class="col-sm-offset-4">
                                    <select name="statutEmploye" class="form-control">
                                        <option <?php
                                        echo "value='" . \app\classes\Employe::ACTIVE . "'";
                                        if ($employe->getEtatActivite() == \app\classes\Employe::ACTIVE)
                                            echo "selected";
                                        ?>
                                        >Active
                                        </option>
                                        <option <?php
                                        echo "value='" . \app\classes\Employe::NON_ACTIVE . "'";
                                        if ($employe->getEtatActivite() == \app\classes\Employe::NON_ACTIVE)
                                            echo "selected";
                                        ?>>Non active
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" name="valider">Sauvegarder</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    }
}