<?php

/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 23/03/2017
 * Time: 22:49
 */
namespace app\table;
use \app\Database;
abstract class Table
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }/*
    public abstract function findByID($id);

    public abstract function findByName($name);

    public abstract function getAll();

    public abstract function create($object);

    public abstract function update($object);

    public abstract function delete($object);*/
}