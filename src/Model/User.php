<?php
namespace App\Model;

class User {

    private $id;
    private $firstname;
    private $lastname;
    private $country;
    private $password;
    private $email;

 
    public function getId() : ?int
    {
        return $this->id;
    }

    public function setId(int $id) : self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstname() : ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname) : self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname() : ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname) : self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCountry() : ?string
    {
        return $this->country;
    }
 
    public function setCountry(string $country) : self
    {
        $this->country = $country;

        return $this;
    }
 
    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email) : self
    {
        $this->email = $email;

        return $this;
    }
}