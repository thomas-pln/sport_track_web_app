<?php

  /**
  * 
  */
  class User{
  
    /**
     * User attributes
     */
    private $idUser;
    private $lName;
    private $fName;
    private $birthday;
    private $sexe;
    private $height;
    private $weight;
    private $email;
    private $pwd;

    /**
      * constructor without parameters
      */
    public function  __construct() { }

    public function init($i, $l, $f, $b, $s, $h, $w, $e, $p){
      $this->idUser = $i;
      $this->lName = $l;
      $this->fName = $f;
      $this->birthday = $b;
      $this->sexe = $s;
      $this->height = $h;
      $this->weight = $w;
      $this->email = $e;
      $this->pwd = $p;
    }

    public function initInsert($l, $f, $b, $s, $h, $w, $e, $p){
      $this->lName = $l;
      $this->fName = $f;
      $this->birthday = $b;
      $this->sexe = $s;
      $this->height = $h;
      $this->weight = $w;
      $this->email = $e;
      $this->pwd = $p;
    }
  
    public function getIdUser(){ return $this->idUser; }
    public function getLastname(){ return $this->lName; }
    public function getFirstname(){ return $this->fName; }
    public function getBirthday(){ return $this->birthday; }
    public function getSexe(){ return $this->sexe; }
    public function getHeight(){ return $this->height; }
    public function getWeight(){ return $this->weight; }
    public function getEmail(){ return $this->email; }
    public function getPassWord(){ return $this->pwd; }

    /**
      * method to print user informations
      */
    public function  UserToString() { return $this->nlName. " ". $this->fName. \n. "birthday : ". $this->birthday. "  sexe : ". $this->sexe. "  height : ". $this->height. "  weight : ". $this->weight. \n. "mail : ". $this->email. "   password : ". $this->pwd;}
    }
?>
