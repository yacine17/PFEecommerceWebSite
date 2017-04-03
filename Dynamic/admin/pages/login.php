<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 03/04/2017
 * Time: 22:58
 */
?>
<div class="container">
    <div class="login col-md-4 col-md-offset-4">
        <form method="post">
            <div class="form-group">
                <div class="">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required autocomplete="off">
                </div>
            </div>
            <div class="form-group" >
                <div class="">
                    <label for="password">Mot de passe:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block">
        </form>
    </div>
</div>