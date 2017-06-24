<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 10/05/2017
 * Time: 00:21
 */

namespace app\table;


use app\classes\Newsletter;

class NewsletterTable extends Table
{
    public function getAll()
    {
        return $this->db->query("SELECT * FROM newsletter", Newsletter::class);
    }
    public function create(Newsletter $newsletter)
    {
        $this->db->prepare("INSERT INTO newsletter VALUES (?, ?)", array($newsletter->getId(), $newsletter->getEmail()));
    }
    public function delete(Newsletter $newsletter)
    {
        $this->db->prepare("DELETE FROM newsletter WHERE id = ?", array($newsletter->getId()));
    }
}