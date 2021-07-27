<?php
/**
 * class person
 * 
 * @author Clément Broucke/ Elvis Gomes
 */
class Person{
    protected $name;
    protected $firstName;
    protected $dateBirth;
    protected $sex;
    protected $adress;
    protected $postCode;
    protected $city;

    public function __construct(){

    }
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of dateBirth
     */ 
    public function getDateBirth()
    {
        return $this->dateBirth;
    }

    /**
     * Set the value of dateBirth
     *
     * @return  self
     */ 
    public function setDateBirth($dateBirth)
    {
        $this->dateBirth = $dateBirth;

        return $this;
    }

    /**
     * Get the value of sex
     */ 
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set the value of sex
     *
     * @return  self
     */ 
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the value of adress
     */ 
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     *
     * @return  self
     */ 
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get the value of postCode
     */ 
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set the value of postCode
     *
     * @return  self
     */ 
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
/**
 * fonction d'affichage de la classe Person
 *
 * @return string
 * 
 * @author Clément Broucke/ Elvis Gomes
 */
    public function __toString(){
        echo $this->name;
        echo PHP_EOL;
        echo $this->firstName;
        echo PHP_EOL;
        echo $this->dateBirth;
        echo PHP_EOL;
        echo $this->sex;
        echo PHP_EOL;
        echo $this->adress;
        echo PHP_EOL;
        echo $this->postCode;
        echo PHP_EOL;
        echo $this->city;
        echo PHP_EOL;
    }
}