<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    
    class SQLiteConnection {
        private static $instance;
        private $pdo;

        private function __construct(){
            try{
                $this->pdo = new PDO('sqlite:./model/sport_track.db'); 
                $this->pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public static function getInstance(){
            if(!isset(self::$instance)) {
                self::$instance= new SQLiteConnection();
            }
            return self::$instance;
        }
        
        public function getConnection(){
            return $this->pdo;
        }
    }

?>