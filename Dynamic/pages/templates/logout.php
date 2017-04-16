<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 05/04/2017
 * Time: 23:07
 */
session_start();
session_unset();
session_destroy();
header('location: ../../public/index.php');