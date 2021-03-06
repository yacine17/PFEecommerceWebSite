<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 21/03/2017
 * Time: 17:21
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['inscriptionNewsletter']) && isset($_POST['emailNewsletter']))
    {
        $email = filter_var($_POST['emailNewsletter'], FILTER_SANITIZE_EMAIL);
        $newsletter = new \app\classes\Newsletter(null, $email);
        $newsDb = new \app\table\NewsletterTable(\app\Config::getInstance()->getDatabase());
        $newsDb->create($newsletter);
    }
}
?>
<!--Start Footer-->
<div class="footer">
    <div class="panel-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Nous suivre sur les réseaux sociaux</h3>
                    <a href=""><i class="fa fa-facebook-square fa-3x"></i></a>
                    <a href=""><i class="fa fa-twitter-square fa-3x"></i></a>
                    <a href=""><i class="fa fa-google-plus-square fa-3x"></i></a>
                    <a href=""><i class="fa fa-instagram fa-3x"></i></a>
                </div>
                <div class="col-md-6">
                    <div class="newsletter">
                        <h3>Inscription à la newsletter</h3>
                        <form role="form" method="post" action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="emailNewsletter" palceholder="Entrez-votre e-mail" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="submit" class="form-control btn-primary" value="S'abonner"
                                               name="inscriptionNewsletter" >
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Ou nous trouver ?</h3>
                    <div id="map">
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Coordonnées</h3>
                    <ul class="list-unstyled">
                        <li>Adresse :</li>
                        <li>Tél :</li>
                        <li>email :</li>
                        <li>Skype :</li>
                        <p>Ouvert du samedi au jeudi de 9h-12h et 13h30-18h</p>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright text-center">
            Designed by Yacine HAMZA-CHERIF & Farah BENSMAIL <i class="fa fa-copyright"></i> All COPYRIGHT RESERVED 2017
        </div>
    </div>
</div>
<!--End Footer-->
<script src="js/jquery-2.2.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/cloud-zoom.js"></script>
<script src="js/myScript.js"></script>
<script>
    function initMap() {
        var uluru = {lat: 34.883251, lng: -1.343243};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDmbceGzPIVBQAZ_Z_4DOVg2gK5rsa8Jg&callback=initMap">
</script>
</body>
</html>
