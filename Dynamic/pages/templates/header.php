<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 21/03/2017
 * Time: 15:29
 */?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= \app\App::getInstance()->title ?></title>
        <!-- css import -->
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/font-awesome.min.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
    </head>
    <body>
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
                                    <input type="text" class="form-control" name=username" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Mot de passe:</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name=motDePasse" required>
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
                        <form role="form">
                            <div class="col-md-6 col-md-offset-3">
                                <label>Nom d'utilisateur:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name=username" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Email:</label>
                                <div class="form-group">
                                    <input type="email" class="form-control" name=email" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                <label>Mot de passe:</label>
                                <div class="form-group">
                                    <input type="password" class="form-control" name=motDePasse" required>
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

    <nav class="navbar navbar-default navbar-fixed-top ">
        <div class="container">
            <div class="row">
                <a class="navbar-brand hvr-buzz-out" href="#">Lib<span>Tech</span>
                    <div class="slogon">'De la culture à revendre'</div></a>
            </div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ournavbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="ournavbar">
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="index.html">Accueil <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?do=cat">Papeterie</a></li>
                            <li><a href="index.php?do=cat">Bureautique</a></li>
                            <li><a href="categorie.html">Informatique</a></li>
                        </ul>
                    </li>
                    <!--<li><a href="#">Promotion</a></li>-->
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="passer%20commande.html">Passer commande</a></li>
                    <li><a href="panier.html" class="fa-parent"><i class="fa fa-shopping-cart"><div class="number-elements">2</div></i></a></li>
                    <li><a href="favoris.html" class="fa-parent"><i class="fa fa-heart"><div class="number-elements">3</div></i></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="se-connecter">Se connecter</a></li></ul>
            </div><!-- /.navbar-collapse -->
            <!-- Collect the nav links, forms, and other content for toggling -->
        </div><!-- /.container-fluid -->
    </nav>
    <!--End Navbar-->
<?= $content ?>
