<?php
//Lisa Le Goff Mauvoisin | Thomas Poulain - 2A

    /**
     * ActivityEntry
     */
  class Data{
  
    /**
     * data attributes
     */
    private $idData;
    private $time;
    private $cardio;
    private $lat;
    private $long;
    private $alti;
    private $dataAct;

    /**
        * constructor without parameters
        */
    public function __construct() { }

    public function init($i, $t, $c, $l, $g, $a, $d){
        $this->idData = $i;
        $this->time = $t;
        $this->cardio = $c;
        $this->lat = $l;
        $this->long = $g;
        $this->alti = $a;
        $this->dataAct = $d;
    }
    
    public function getIdData(){ return $this->idData; }
    public function getTime(){ return $this->time; }
    public function getCardio(){ return $this->cardio; }
    public function getLatitude(){ return $this->lat; }
    public function getLongitude(){ return $this->long; }
    public function getAltitude(){ return $this->alti; }
    public function getDataAct(){ return $this->dataAct; }

    /**
        * method to print a data
        */
    public function  __toString() { return "time : ". $this->time. " frequence : ". $this->cardio. \n. "latitude : ". $this->lat. "  longitude : ". $this->long. "  altitude : ". $this->alti. \n. "activity : ". $this->dataAct;}
    }
?>
