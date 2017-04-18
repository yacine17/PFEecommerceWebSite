<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 21/03/2017
 * Time: 16:34
 */

namespace app;


class App
{
    public $title = 'LibTech';
    public $active = 'accueil';
    private static $instance;

    /**
     * App constructor.
     */
    private function __construct()
    {
    }
    /**
     * @return mixed Instance de la classe App
     */
    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new App();
        return self::$instance;
    }

}