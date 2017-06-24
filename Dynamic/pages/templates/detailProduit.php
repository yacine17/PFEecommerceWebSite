<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/04/2017
 * Time: 23:23
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    @ session_start();
    if (isset($_GET['id']) && !empty($_GET['id']))
    {
        require '..\..\app\Autoloader.php';
        app\Autoloader::register();
        $idProduit = $_GET['id'];
        $db = \app\Config::getInstance()->getDatabase();
        $produitDb = new \app\table\ProduitTable($db);
        $produit = $produitDb->findById($idProduit);
        if ($produit)
        {
            $produit->setNombreDeVus((intval($produit->getNombreDeVus() ) + 1));
            $produitDb->update($produit);
            $produitFavoris = '';
            if (isset($_SESSION['favoris']) && in_array($produit->getIdProduit(), $_SESSION['favoris']))
                $produitFavoris = 'added-to-favorite';
            ?>
            <div class="modal-dialog modal-lg" role="document">
                <style type="text/css">
                    /* This is the moving lens square underneath the mouse pointer. */
                    .cloud-zoom-lens {
                        border: 4px solid #888;
                        margin:-4px;	/* Set this to minus the border thickness. */
                        background-color:#fff;
                        cursor:move;
                    }

                    /* This is for the title text. */
                    .cloud-zoom-title {
                        font-family:Arial, Helvetica, sans-serif;
                        position:absolute !important;
                        background-color:#000;
                        color:#fff;
                        padding:3px;
                        width:100%;
                        text-align:center;
                        font-weight:bold;
                        font-size:10px;
                        top:0px;
                    }

                    /* cloud zoom wrapper styles */
                    .cloud-zoom-wrap {
                        top:0;
                        z-index:9999;
                        position:relative;
                    }

                    /* This is the zoom window. */
                    .cloud-zoom-big {
                        border:4px solid #ccc;
                        width: 500px;
                        overflow:hidden;
                    }

                    /* This is the loading message. */
                    .cloud-zoom-loading {
                        color:white;
                        background:#222;
                        padding:3px;
                        border:1px solid #000;
                    }

                </style>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h1 class="modal-title" id="myModalLabel"><?= $produit->getLibelle() ?></h1>
                    </div>
                    <div class="modal-body">
                        <div class="row detail-produit">
                            <div class="col-md-4 image-produit">
                                <div>
                                    <a href="../images/<?= $produit->getCheminPhoto() ?>" class="cloud-zoom"
                                       rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: true, zoomWidth:'300', zoomHeight:'400', adjustY:0, adjustX:10">
                                        <img src="../images/<?= $produit->getCheminPhoto() ?>">
                                    </a>

                                </div>
                            </div>
                            <div class="col-md-8 cara-produit">
                                <div class="row">
                                    <div>
                                        <h3>Prix : <span class="prix"><?= $produit->getPrix() ?> DA</span></h3>
                                        <p><?= $produit->getDescription() ?></p>
                                        <h3>Caractéristiques:</h3>
                                        <ul>
                                            <?php foreach ($produit->getCaracteristiques() as $caracteristique)
                                            {
                                                echo "<li><strong>" . $caracteristique->getNom() . "</strong> : " . $caracteristique->getCaractere() ."</li>";
                                            }?>
                                        </ul>
                                        <div class="buttons">
                                            <a  href='../pages/gestionPanier.php?id=<?=$produit->getIdProduit() ?>'
                                                class="cart-add btn btn-warning"><i class="fa fa-cart-plus"></i> Ajouter au panier</a>
                                            <a class="favori-add"
                                            <?php if ($produitFavoris == '')
                                                echo "class='favori-add' href='../pages/gestionFavoris.php?id=" . $produit->getIdProduit() . "'";
                                            else
                                                echo "class='supprimerFavori' href='../pages/gestionFavoris.php?do=supprimer&id=" . $produit->getIdProduit() . "''";
                                                ?>>
                                                <span class="add-to-favorite" title="Ajouter au favoris">
                                                    <span class="fa-stack fa-lg">
                                                        <i class="fa fa-heart fa-stack-2x <?= $produitFavoris ?>"></i>
                                                        <i class="fa fa-heart-o fa-stack-2x <?= $produitFavoris ?>"></i>
                                                    </span>
                                                </span>
                                            </a>
                                            <button class="btn btn-primary btn-block">
                                                <i class="fa fa-plus-square"></i> Ajouter au comparateur
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="js/cloud-zoom.js"></script>
            <script>

                $(".cart-add").on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var url = $this.attr('href');
                    $.ajax(url)
                        .done(function () {
                            var count = parseInt($(".fa-shopping-cart .number-elements").text());
                            $(".fa-shopping-cart .number-elements").text(++count);

                        })
                        .fail(function () {

                        }).always(function () {

                    });
                });
                /**
                 * Ajouter un produit au favori
                 */
                $(".detail-produit .cara-produit .add-to-favorite").on('click', function () {
                    if ($(this).find(".fa").hasClass("added-to-favorite"))
                        $(this).find(".fa").removeClass("added-to-favorite");
                    else
                        $(this).find(".fa").addClass("added-to-favorite");
                });
                /**
                 * Ajouter un produit au favoris
                 */
                $(".favori-add").on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var url = $this.attr('href');
                    $.ajax(url)
                        .done(function () {
                            var count = parseInt($(".fa-heart .number-elements").text());
                            $(".fa-heart .number-elements").text(++count);
                            $this.addClass("supprimerFavori");
                            $this.removeClass("favori-add");
                            url = url + '&do=supprimer';
                            $this.attr('href', url);
                        }).fail(function () {

                    }).always(function () {

                    });
                });
                /**
                 * Enlver un produit de la liste des favoris
                 */
                $(".supprimerFavori").on('click', function (e) {
                    e.preventDefault();
                    if (confirm("Etes vous sur de vouloir supprimer cet article de votre lite des favoris?"))
                        var $this = $(this);
                    var url = $this.attr('href');
                    $.ajax(url)
                        .done(function () {
                            var count = parseInt($(".fa-heart .number-elements").text());
                            $(".fa-heart .number-elements").text(--count);
                            $this.addClass("favori-add");
                            $this.removeClass("supprimerFavori");
                            url = url.replace('&do=supprimer', '');
                            console.log(url);
                            $this.attr('href', url)
                        }).fail(function () {
                        $this.find(".fa").addClass("added-to-favorite");
                    }).always(function () {

                    });
                });
            </script>


        <?php
        }
    }
}
?>