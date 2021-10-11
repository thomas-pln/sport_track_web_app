<?php
//Lisa Le Goff Mauvoisin | Thomas Poulain - 2A

    require_once('SQLiteConnection.php');
    require_once('User.php');

    class UserDAO{
        private static $dao;

        private function __construct() {}

        public final static function getInstance() {
            if(!isset(self::$dao)) {
                self::$dao= new UserDAO();
            }
            return self::$dao;
        }




        public final function findAll(){
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "select * from User order by lName,fName";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'User');
        return $results;
        }



        /**
         * Insère un User
         */
        public final function insert($st){
            if($st instanceof User){
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "INSERT INTO User(fname, lName, birthday, sexe, height, weight, email, pwd) VALUES (:f,:l,:b,:s,:h,:w,:e,:p)";
                $stmt = $dbc->prepare($query);
        
                // bind the paramaters
                $stmt->bindValue(':f',$st->getFirstname(),PDO::PARAM_STR);
                $stmt->bindValue(':l',$st->getLastname(),PDO::PARAM_STR);
                $stmt->bindValue(':b',$st->getBirthday(),PDO::PARAM_STR);
                $stmt->bindValue(':s',$st->getSexe(),PDO::PARAM_STR);
                $stmt->bindValue(':h',$st->getHeight(),PDO::PARAM_STR);
                $stmt->bindValue(':w',$st->getWeight(),PDO::PARAM_STR);
                $stmt->bindValue(':e',$st->getEmail(),PDO::PARAM_STR);
                $stmt->bindValue(':p',$st->getPassWord(),PDO::PARAM_STR);

                // execute the prepared statement
                $result = $stmt->execute();
                return $result; 
            }
        }

        /**
         * Supprime un User
         */
        public function delete($st){
            if($st instanceof User){
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "DELETE FROM User WHERE :i = idUser";
                $stmt = $dbc->prepare($query);
       
                // bind the paramaters
                $stmt->bindValue(':i',$st->getIdUser(),PDO::PARAM_STR);
     
                // execute the prepared statement
                $stmt->execute();
            }
        }
        

        /**
         * Met à jour un User
         */
        public function update($st){
            if($st instanceof User){
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "UPDATE User SET fname=:f, lName=:l, birthday=:b, sexe=:s, height=:h, weight=:w, email=:e, pwd=:p WHERE idUser = :id ";
                $stmt = $dbc->prepare($query);
       
                // bind the paramaters
                $stmt->bindValue(':f',$st->getFirstname(),PDO::PARAM_STR);
                $stmt->bindValue(':l',$st->getLastname()(),PDO::PARAM_STR);
                $stmt->bindValue(':b',$st->getBirthday(),PDO::PARAM_STR);
                $stmt->bindValue(':s',$st->getSexe(),PDO::PARAM_STR);
                $stmt->bindValue(':h',$st->getHeight(),PDO::PARAM_STR);
                $stmt->bindValue(':w',$st->getWeight(),PDO::PARAM_STR);
                $stmt->bindValue(':e',$st->getEmail(),PDO::PARAM_STR);
                $stmt->bindValue(':p',$st->getPassWord(),PDO::PARAM_STR);
                $stmt->bindValue(':id',$st->getIdUser(),PDO::PARAM_STR);
                // execute the prepared statement
                $stmt->execute();
             }
        }
        

        
        /**
         * Vide la table User
         */
        public function purge(){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "DELETE FROM User";
            $stmt = $dbc->prepare($query);
            // execute the prepared statement
            $stmt->execute();
        }




        public function getNbUsrEmail($st){
            if($st instanceof User){
                $dbc = SqliteConnection::getInstance()->getConnection();
                // prepare the SQL statement
                $query = "SELECT COUNT(*) AS nb FROM User WHERE :e = email ";
                $stmt = $dbc->prepare($query);
       
                // bind the paramaters
                $stmt->bindValue(':e',$st->getEmail(),PDO::PARAM_STR);
                // execute the prepared statement
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
             }
        }


        public function find($mail){
            $dbc = SqliteConnection::getInstance()->getConnection();
            // prepare the SQL statement
            $query = "SELECT * FROM User WHERE :mail = email ";
            $stmt = $dbc->prepare($query);
            $stmt->bindValue(':mail',$mail,PDO::PARAM_STR);
            // execute the prepared statement
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


    }
?>