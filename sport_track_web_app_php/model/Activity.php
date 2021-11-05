<?php

  class Activity{
  
    /**
     * activity attributes
     */
    private $idAct;
    private $date;
    private $description;
    private $distance;
    private $ttTime;
    private $startTime;
    private $freqMax;
    private $freqMoy;
    private $freqMin;
    private $refUser;


    /**
        * constructor without parameters
        */
    public function __construct() { }

    /**
     * Init Activity
     */
    public function init($i, $d, $ds, $di, $t, $s, $fx, $fy, $fn, $u){
        $this->idAct = $i;
        $this->date = $d;
        $this->description = $ds;
        $this->distance = $di;
        $this->ttTime = $t;
        $this->startTime = $s;
        $this->freqMax = $fx;
        $this->freqMoy = $fy;
        $this->freqMin = $fn;
        $this->refUser = $u;
    }
    
    public function getIdAct(){ return $this->idAct; }
    public function getDate(){ return $this->date; }
    public function getDescription(){ return $this->description; }
    public function getDistance(){ return $this->distance; }
    public function getTotalTime(){ return $this->ttTime; }
    public function getStartTime(){ return $this->startTime; }
    public function getFreqMax(){ return $this->freqMax; }
    public function getFreqMoy(){ return $this->freqMoy; }
    public function getFreqMin(){ return $this->freqMin; }
    public function getRefUser(){ return $this->refUser; }

    /**
        * method to print a activity
        */
    public function  __toString() { return "date : ". $this->date. " description : ". $this->description. "  distance : ". $this->distance. "  Time : ". $this->ttTime. "  frequence maximum : ". $this->freqMax. "  frequence minimum : ". $this->freqMin. "  frequence moyenne : ". $this->freqMoy;}
    }
?>
