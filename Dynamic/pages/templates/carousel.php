<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:24
 */?>
<!--Start Carousel-->
<div class="slide">
    <div class="container">
        <div>
            <div id="myslide" class="carousel" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myslide" data-slide-to="0" class="active"></li>
                    <li data-target="#myslide" data-slide-to="1"></li>
                    <li data-target="#myslide" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="img/image-slide.jpg" alt="Image 1" class="center-block">
                        <div class="carousel-caption">
                            Premier slide exemple exemple exemple
                        </div>
                    </div>
                    <div class="item">
                        <img src="img/img2.png" alt="Image 2" class="center-block">
                        <div class="carousel-caption">
                            Deuxieme slide exemple exemple exemple
                        </div>
                    </div>
                    <div class="item">
                        <img src="img/img3.png" alt="Image 3" class="center-block">
                        <div class="carousel-caption">
                            Troisieme slide exemple exemple exemple
                        </div>
                    </div>
                    ...
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
        </div>
        <div class="row text-center categories-home">
            <a href="categorie.html">
                <div class="col-lg-4 col-md-6 col-xs-12 categorie">
                    <img src="img/papetrie.jpg">
                    <h3>Papeterie</h3>
                    <h6>voir categorie</h6>
                </div>
            </a>
            <a href="categorie.html">
                <div class="col-lg-4 col-md-6 col-xs-12 categorie">
                    <img src="img/bureautique.jpg">
                    <h3>Bureautique</h3>
                    <h6>voir categorie</h6>
                </div>
            </a>
            <a href="categorie.html">
                <div class="col-lg-4 col-md-6 col-xs-12 categorie">
                    <img src="img/informatique.jpg">
                    <h3>Informatique</h3>
                    <h6>voir categorie</h6>
                </div>
            </a>
        </div>
    </div>
</div>
<!--End Carousel-->
