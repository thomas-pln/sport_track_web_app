<?php
    require_once('Controller.php');
    require_once('./model/User.php');
    require_once('./model/UserDAO.php');

    /**
     * Controller d'ajout d'utilisateur dans la BDD
     */
    class AddUserController implements Controller{

        public function handle($request){
            if(isset($_POST['register-submit'])){
                $this->add_usr();
            }
        }


        /**
         * Vérification pour insérer le nouvel utilisateur (User)
         */
        public function newUser($usr){
            $usrDAO = UserDAO::getInstance();

            $nbUsr = $usrDAO->getNbUsrEmail($usr);

            if($nbUsr['nb'] != "0"){ //Utilisateur déjà existant
                $_SESSION['errMail'] = '<p>Email déjà utilisé</p>';
            }elseif($usr->getHeight()<=0){
                $_SESSION['errTaille'] ='<p>Votre taille ne peut pas être négative ou nulle</p>';
            }elseif($usr->getWeight()<=0){
                $_SESSION['errPoids'] ='<p>Votre poids ne peut pas être négatif ou nulle</p>';
            }elseif(!filter_var($usr->getEmail(), FILTER_VALIDATE_EMAIL)){ //Regex email
                $_SESSION['errMail'] ='<p>Adresse mail invalide</p>';
            }else{
                $successful=$usrDAO->insert($usr);
                if($successful == "1"){
                    $_SESSION['message'] = '<p>Félicitation, vous venez de créer votre compte</p>';
                }else{
                    $_SESSION['errCreate'] ='<p>La création de votre compte à échoué</p>';
                }
            }
        }


        /**
         * Créer un objet User
         */
        public function add_usr(){
            $usr = new User();
            $fName = $_POST['fname'];
            $lName = $_POST['lname'];
            $birthday = $_POST['birthday'];
            $sexe = $_POST['gender'];
            $height =(int) $_POST['height'];
            $weight= (int) $_POST['weight'];
            $email = $_POST['emailA'];
            $pwd = $_POST['pwd'];

            $usr->init(-1, $fName, $lName, $birthday, $sexe, $height, $weight, $email, $pwd);

            $this->newUser($usr);   
        }

    }

    

?>