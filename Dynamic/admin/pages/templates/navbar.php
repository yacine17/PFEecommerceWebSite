<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 02/04/2017
 * Time: 22:04
 */?>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientèle <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Commandes client</a></li>
                        <li><a href="#">Factures</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Newsletter</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Vitrine & stock <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Gestion Produits</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Etablir commande</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="pages/templates/logout.php">Déconnexion</a> </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>