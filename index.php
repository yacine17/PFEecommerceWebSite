<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- css import -->
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>

    <!--[if lt IE 9]>
    <script src="bower_components/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top ">
        <div class="container">
            <div class="row" style="margin-top: 10px">
                <a class="navbar-brand hvr-buzz-out" href="#">Lib<span>Shop</span>
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
                    <li class="active"><a href="#">Accueil <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Categorie</a></li>
                    <li><a href="#">Boutique</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Inforamations</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Se connecter</a></li>
                    <li><a href="#">S'inscrire</a></li>
                    <i class="fa fa-shopping-cart fa-2x"></i>
                    <i class="fa fa-heart fa-2x"></i>
                </ul>
            </div><!-- /.navbar-collapse -->
            <!-- Collect the nav links, forms, and other content for toggling -->


        </div><!-- /.container-fluid -->
    </nav>
    <!--End Navbar-->
    <!--Start Carousel-->
    <div id="myslide" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators hidden-xs">
            <li data-target="#myslide" data-slide-to="0" class="active"></li>
            <li data-target="#myslide" data-slide-to="1"></li>
            <li data-target="#myslide" data-slide-to="2"></li>
            <li data-target="#myslide" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/01.jpg" alt="..." class="center-block">
                <div class="carousel-caption hidden-xs">
                    <h2 class="h1">Picture 1</h2>
                    <p class="lead">Bootstrap exclusively uses CSS3 for its animations, but Internet Explorer 8 & 9 don't support the necessary CSS properties. Thus, there are no slide transition animations when using these browsers. We have intentionally decided not to include jQuery-based fallbacks for the transitions.</p>
                </div>
            </div>
            <div class="item">
                <img src="images/02.jpg" alt="..." class="center-block">
                <div class="carousel-caption hidden-xs">
                    <h2 class="h1">Picture 2</h2>
                    <p class="lead">Bootstrap exclusively uses CSS3 for its animations, but Internet Explorer 8 & 9 don't support the necessary CSS properties. Thus, there are no slide transition animations when using these browsers. We have intentionally decided not to include jQuery-based fallbacks for the transitions.</p>
                </div>
            </div>

            <div class="item">
                <img src="images/03.jpg" alt="..." class="center-block">
                <div class="carousel-caption hidden-xs">
                    <h2 class="h1">Picture 3</h2>
                    <p class="lead">Bootstrap exclusively uses CSS3 for its animations, but Internet Explorer 8 & 9 don't support the necessary CSS properties. Thus, there are no slide transition animations when using these browsers. We have intentionally decided not to include jQuery-based fallbacks for the transitions.</p>
                </div>
            </div>

            <div class="item">
                <img src="images/04.jpg" alt="..." class="center-block">
                <div class="carousel-caption hidden-xs">
                    <h2 class="h1">Picture 4</h2>
                    <p class="lead">Bootstrap exclusively uses CSS3 for its animations, but Internet Explorer 8 & 9 don't support the necessary CSS properties. Thus, there are no slide transition animations when using these browsers. We have intentionally decided not to include jQuery-based fallbacks for the transitions.</p>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myslide" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myslide" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!--End Carousel-->
    <script src="js/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>