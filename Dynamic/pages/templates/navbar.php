<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:20
 */?>
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
                <li class="active"><a href="index.php?do=home">Accueil <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?do=cat">Papeterie</a></li>
                        <li><a href="index.php?do=cat">Bureautique</a></li>
                        <li><a href="index.php?do=cat">Informatique</a></li>
                    </ul>
                </li>
                <!--<li><a href="#">Promotion</a></li>-->
                <li><a href="contact.html">Contact</a></li>
                <li><a href="passer%20commande.html">Passer commande</a></li>
                <li><a href="panier.html" class="fa-parent"><i class="fa fa-shopping-cart"><div class="number-elements">2</div></i></a></li>
                <li><a href="favoris.html" class="fa-parent"><i class="fa fa-heart"><div class="number-elements">3</div></i></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="se-connecter" data-toggle="modal" data-target="#loginModal">Se connecter</a></li></ul>
        </div><!-- /.navbar-collapse -->
        <!-- Collect the nav links, forms, and other content for toggling -->
    </div><!-- /.container-fluid -->
</nav>
<!--End Navbar-->
