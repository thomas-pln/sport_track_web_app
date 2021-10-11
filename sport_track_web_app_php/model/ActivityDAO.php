<?php
//Lisa Le Goff Mauvoisin | Thomas Poulain - 2A

require_once('SQLiteConnection.php');
require_once('Activity.php');

class ActivityDAO {
    private static $dao;

    public function __construct() {}

    public final static function getInstance() {
       if(!isset(self::$dao)) {
           self::$dao= new ActivityDAO();
       }
       return self::$dao;
    }
        /**
         * Toutes les activités de la table Acivité
         */
    public final function findAll(){
       $dbc = SqliteConnection::getInstance()->getConnection();
       $query = "SELECT * from Activity order by idAct";
       $stmt = $dbc->query($query);
       $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Activity');
       return $results;
    }

    /**
     * Insérer une activité
     */
      public final function insert($st){
         if($st instanceof Activity){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "INSERT into Activity(idAct, date, description, distance, startTime, ttTime, freqMax, freqMin, freqMoy, refUser) values (:id,:d,:ds,:di,:s,:t,:fx,:fm,:fy,:u )";
            $stmt = $dbc->prepare($query);
            // bind the paramaters
            $stmt->bindValue(':id',$st->getIdAct(),PDO::PARAM_STR);
            $stmt->bindValue(':d',$st->getDate(),PDO::PARAM_STR);
            $stmt->bindValue(':ds',$st->getDescription(),PDO::PARAM_STR);
            $stmt->bindValue(':di',$st->getDistance(),PDO::PARAM_STR);
            $stmt->bindValue(':t',$st->getTotalTime(),PDO::PARAM_STR);
            $stmt->bindValue(':s',$st->getStartTime(),PDO::PARAM_STR);
            $stmt->bindValue(':fx',$st->getFreqMax(),PDO::PARAM_INT);
            $stmt->bindValue(':fy',$st->getFreqMoy(),PDO::PARAM_INT);
            $stmt->bindValue(':fm',$st->getFreqMin(),PDO::PARAM_INT);
            $stmt->bindValue(':u',$st->getRefUser(),PDO::PARAM_INT);


            // execute the prepared statement
            $stmt->execute();
      }
   }



   /**
    * Cherche un tuple User à partie de son Id
    */
   public final function findAllUser($idUser){
      $dbc = SqliteConnection::getInstance()->getConnection();
      $query = "SELECT * FROM Activity WHERE  refUser= :id ORDER BY date";
      $stmt = $dbc->query($query);
      $stmt->bindValue(":id",$idUser,PDO::PARAM_INT);
      $stmt->execute();

      $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Activity');
      return $results;
   }



   /**
    * Supprime une activité
    */
   public function delete($st){ 
      if($st instanceof Activity){
         $dbc = SqliteConnection::getInstance()->getConnection();
         // prepare the SQL statement
         $query = "DELETE FROM Activity WHERE :i = idAct";
         $stmt = $dbc->prepare($query);

         // bind the paramaters
         $stmt->bindValue(':i',$st->getIdAct(),PDO::PARAM_INT);

         // execute the prepared statement
         $stmt->execute();
      }
   }

   /**
    * Met à jour une activité
    */
   public function update($st){
      if($st instanceof Activity){
         $dbc = SqliteConnection::getInstance()->getConnection();
         // prepare the SQL statement
         $query = "UPDATE Activity SET date=:d, description=:ds, distance=:di, ttTime=:t, startTime=:s, freqMax=:fx, freqMoy=:fy, freMin=:fn, refUser=:u";
         $stmt = $dbc->prepare($query);

         // bind the paramaters
         $stmt->bindValue(':d',$st->getDate(),PDO::PARAM_STR);
         $stmt->bindValue(':ds',$st->getDescription(),PDO::PARAM_STR);
         $stmt->bindValue(':di',$st->getDistance(),PDO::PARAM_INT);
         $stmt->bindValue(':t',$st->getTotalTime(),PDO::PARAM_STR);
         $stmt->bindValue(':s',$st->getStartTime(),PDO::PARAM_STR);
         $stmt->bindValue(':fx',$st->getFreqMax(),PDO::PARAM_INT);
         $stmt->bindValue(':fy',$st->getFreqMoy(),PDO::PARAM_INT);
         $stmt->bindValue(':fn',$st->getFreqMin(),PDO::PARAM_INT);
         $stmt->bindValue(':u',$st->getRefUser(),PDO::PARAM_INT);

         // execute the prepared statement
         $stmt->execute();
      }
   }

   /**
    * Cherche les activités d'un User
    */
   public function findUserActivities($st){
      if($st instanceof Activity){
         $dbc = SqliteConnection::getInstance()->getConnection();
         $query = "SELECT * from Activity WHERE :u = refUser";
         $stmt = $dbc->prepare($query);

         $stmt->bindValue(':u',$st->getRefUser(),PDO::PARAM_INT);

         $results = $stmt->execute();

         return $results;
      }
   }

   public function uniqueAct($st){
      if($st instanceof Activity){
          $dbc = SqliteConnection::getInstance()->getConnection();
          // prepare the SQL statement
          $query = "SELECT COUNT(*) AS nb, idAct FROM Activity WHERE :d = date AND :ds = description AND :usr = refUser";
          $stmt = $dbc->prepare($query);
 
          // bind the paramaters
          $stmt->bindValue(':d',$st->getDate(),PDO::PARAM_STR);
          $stmt->bindValue(':ds',$st->getDescription(),PDO::PARAM_STR);
          $stmt->bindValue(':ds',$st->getRefUser(),PDO::PARAM_STR);
          // execute the prepared statement
          $stmt->execute();
          return $stmt->fetch(PDO::FETCH_ASSOC);
       }
  }

}
?>
