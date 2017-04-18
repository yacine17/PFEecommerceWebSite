<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:20
 */
use app\App; ?>
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
                <li <?php if (App::getInstance()->active == 'accueil') echo "class='active'"?>><a href="index.php?do=home">Accueil <span class="sr-only">(current)</span></a></li>
                <li class="dropdown <?php if (App::getInstance()->active == 'categrie') echo " active" ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="categorie.php?idCat=1">Papeterie</a></li>
                        <li><a href="categorie.php?idCat=2">Bureautique</a></li>
                        <li><a href="categorie.php?idCat=3">Informatique</a></li>
                    </ul>
                </li>
                <!--<li><a href="#">Promotion</a></li>-->
                <li <?php if (App::getInstance()->active == 'contact') echo "class='active'"?>><a href="contact.html">Contact</a></li>
                <li <?php if (App::getInstance()->active == 'passerCommande') echo "class='active'"?>><a href="passer%20commande.html">Passer commande</a></li>
                <li <?php if (App::getInstance()->active == 'panier') echo "class='active'" ?>><a href="panier.php" class="fa-parent">
                        <i class="fa fa-shopping-cart">
                            <div class='number-elements '>
                            <?php if (isset($_SESSION['panier']) && (count($_SESSION['panier']) > 0))
                                        echo count($_SESSION['panier']);
                                    else
                                        echo "0";
                            ?>
                            </div>
                        </i>
                    </a>
                </li>
                <li <?php if (App::getInstance()->active == 'favoris') echo "class='active'" ?>><a href="favoris.php" class="fa-parent">
                        <i class="fa fa-heart">
                            <div class="number-elements">
                                <?php if (isset($_SESSION['favoris']) && (count($_SESSION['favoris']) > 0))
                                    echo count($_SESSION['favoris']);
                                else
                                    echo "0";
                                ?>
                            </div>
                        </i>
                    </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if (\app\classes\Authentification::estConnecte())
                    {
                       echo "<li class='dropdown'>
                                <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' 
                                aria-haspopup='true' aria-expanded='false'>" . $_SESSION['auth']['username'] . "<span class='caret'></span></a>
                                <ul class='dropdown-menu'>
                                    <li><a href=''>Modifier profil</a></li>
                                    <li><a href=''>Mes commandes</a></li>
                                    <li><a href='../pages/templates/logout.php'>Deconnexion</a></li>
                                </ul>   
                            </li>";
                    }
                    else
                    {
                        echo "<li><a class=\"se-connecter\" data-toggle=\"modal\" data-target=\"#loginModal\">Se connecter</a></li>";
                    }
                ?>

            </ul>
        </div><!-- /.navbar-collapse -->
        <!-- Collect the nav links, forms, and other content for toggling -->
    </div><!-- /.container-fluid -->
</nav>
<!--End Navbar-->
