<?php

namespace model;

/**
 * Model that contains the info related to users.
 *
 * Class User
 * @package model
 */
class User {

    /** @var  $id int */
    private $id;
    /** @var  $email string */
    private $email;
    /** @var  $name string */
    private $name;

    /**
     * User constructor.
     * @param int $id
     * @param string $email
     * @param string $name
     */
    public function __construct($id, $email, $name)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}