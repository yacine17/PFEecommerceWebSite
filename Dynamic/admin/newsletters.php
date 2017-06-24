<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 06/04/2017
 * Time: 15:33
 */
use app\classes\Authentification;
session_start();
require '..\app\Autoloader.php';
app\Autoloader::register();
if (Authentification::estConnecte() && Authentification::estEmploye())
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $newsDb = new \app\table\NewsletterTable(\app\Config::getInstance()->getDatabase());
        $newsletters = $newsDb->getAll();
        foreach ($newsletters as $newsletter)
        {
            /**
             * @var $newsletter \app\classes\Newsletter
             */
            if (isset($_POST['newsletter']))
            {
                $sujet = 'LibTech newsletter';


                mail($newsletter->getEmail(), $sujet, $_POST['newsletter']);
            }
        }
    }
    \app\App::getInstance()->title = 'Newsletters';
    require 'pages/templates/header.php';
    require 'pages/templates/navbar.php';
?>
    <div class="container">
        <div class="newsletter">
            <h1 class="text-center">Newsletter</h1>
            <form method="post" action="">
                <div class="col-xs-12">
                    <label for="newsletter" class="col-sm-2 control-label">Message:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="newsletter" name="newsletter"
                                  placeholder="Entrez votre message" required rows="7"></textarea>
                    </div>
                </div>
                <div class="col-md-1 col-md-offset-11"><br><button type="submit" class="btn btn-primary">Envoyer</button> </div>
            </form>
        </div>

    </div>
<?php

    require 'pages/templates/footer.php';
}
else
{
    header('location: index.php');
}