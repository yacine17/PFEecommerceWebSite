<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:31
 */?>
<!--Start Search Bar-->
<div class="container">
    <div class="row search-bar">
        <div class="col-md-8 col-md-offset-2">
            <form method="post" action="?do=search" role="form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher..." autocomplete="on" id="searchBar" name="search">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                    </span>
                </div><!-- /input-group -->
            </form>
        </div>
    </div>
</div>
<div id="goToSearch" class="text-center">
    <i class="fa fa-search fa-2x"></i>
</div>
<!--End Search Bar-->
