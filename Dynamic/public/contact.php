<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/04/2017
 * Time: 00:32
 */
require '..\app\Autoloader.php';
app\Autoloader::register();
\app\App::getInstance()->active = 'contact';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $nom = filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    $erreursForm = array();
    if (strlen($nom) <= 3)
        $erreursForm[] = 'Le nom doit être plus long que <strong>3</strong> caractéres';
    if (strlen($message) <= 10)
        $erreursForm[] = 'Le message doit contient plus de <strong>10</strong> caractéres';
    $enTete = "From " . $email . "\r\n \r\n";
    $monEmail = "libtech013@gmail.com";
    $sujet = "Formulaire de contact";

    if (empty($erreursForm))
    {
        mail($monEmail, $sujet, $enTete . $message);
        $succes = "<div class='alert alert-success'>Votre message à était bien envoyé, Merci</div>";
    }
}
require '../pages/templates/header.php';
require '../pages/templates/login.php';
require '../pages/templates/modifierProfil.php';
require '../pages/templates/navbar.php';
?>
    <div class="contact">
        <div class="container">
            <h1 class="text-center">NOUS CONTACTER</h1>
            <?php
            if (isset($succes))
                echo $succes;
            ?>
            <div class="row">
                <form role="form" action="contact.php" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control input-lg " placeholder="Nom" name="nom">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-lg" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control input-lg" placeholder="Tapez votre message" name="message"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary btn-lg right-float" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
require '../pages/templates/footer.php';