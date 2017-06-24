<?php
/**
 * Created by PhpStorm.
 * User: Yacine
 * Date: 10/05/2017
 * Time: 00:18
 */

namespace app\classes;


class Newsletter
{

    private $id;
    private $email;

    public function __construct($id = null, $email = null)
    {
        if (isset($id))
            $this->id = $id;
        if (isset($email))
            $this->email = $email;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}