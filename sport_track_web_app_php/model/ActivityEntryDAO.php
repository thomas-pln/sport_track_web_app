<?php
//Lisa Le Goff Mauvoisin | Thomas Poulain - 2A

    require_once('SQLiteConnection.php');
    require_once('Data.php');

    /**
     * ActivityEntry DAO
     */
    class ActivityEntryDAO{
        private static $dao;

        private function __construct() {}

        public final static function getInstance() {
            if(!isset(self::$dao)) {
                self::$dao= new ActivityEntryDao();
            }
            return self::$dao;
        }


        /**
         * Toutes les données de la table Data
         */
        public final function findAll(){
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from Data order by idData";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Data');
        return $results;
        }



        /**
         * Insérer une donnée
         */
        public final function insert($st){
            if($st instanceof Data){
               $dbc = SqliteConnection::getInstance()->getConnection();
               // prepare the SQL statement
               $query = "INSERT INTO Data(idData, time, cardio, long, lat, alti, dataAct) VALUES (:id,:t,:c,:lo,:la,:a,:ref)";
               $stmt = $dbc->prepare($query);
      
               // bind the paramaters
               $stmt->bindValue(':c',$st->getIdData(),PDO::PARAM_INT);
               $stmt->bindValue(':t',$st->getTime(),PDO::PARAM_STR);
               $stmt->bindValue(':c',$st->getCardio(),PDO::PARAM_INT);
               $stmt->bindValue(':lo',$st->getLongitude(),PDO::PARAM_STR);
               $stmt->bindValue(':la',$st->getLatitude(),PDO::PARAM_STR);
               $stmt->bindValue(':a',$st->getAltitude(),PDO::PARAM_STR);
               $stmt->bindValue(':ref',$st->getDataAct(),PDO::PARAM_STR);
    
               // execute the prepared statement
               $stmt->execute();
            }
        }

        /**
         * Supprimer une donnée
         */
        public function delete($st){
            if($st instanceof Data){
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "DELETE FROM Data WHERE :i = idData";
                $stmt = $dbc->prepare($query);
       
                // bind the paramaters
                $stmt->bindValue(':i',$st->getIdData(),PDO::PARAM_STR);
     
                // execute the prepared statement
                $stmt->execute();
            }
        }
        

        /**
         * Mettre à jour une donnée
         */
        public function update($st){
            if($st instanceof Data){
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "UPDATE Data SET cardio=:c, long=:lo, lat=:la, alti=:a WHERE :id = idData";
                $stmt = $dbc->prepare($query);
       
                // bind the paramaters
                $stmt->bindValue(':c',$st->getCardio(),PDO::PARAM_STR);
                $stmt->bindValue(':lo',$st->getLong(),PDO::PARAM_STR);
                $stmt->bindValue(':la',$st->getLat(),PDO::PARAM_STR);
                $stmt->bindValue(':a',$st->getAlti(),PDO::PARAM_STR);
                $stmt->bindValue(':id',$st->getIdData(),PDO::PARAM_STR);
                // execute the prepared statement
                $stmt->execute();
             }
        }
        
/* lister l’ensemble des données et de lister les données issues d’une activité particulière.*/
        
        public final function findDataAct($st){
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = 'SELECT * FROM Data WHERE :act = dataAct';
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':act',$st->getDataAct(),PDO::PARAM_STR);
            $results = $stmt->execute();
            return $results;
        }


        public final function findData($st){
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = 'SELECT * FROM Data WHERE :id = idData';
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':id',$st->getIdData(),PDO::PARAM_STR);
            $results = $stmt->execute();
            return $results;
        }

        /**
         * Vide la table Data
         */
        public function purge(){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "DELETE FROM Data";
            $stmt = $dbc->prepare($query);
            // execute the prepared statement
            $stmt->execute();
        }

    }
?>