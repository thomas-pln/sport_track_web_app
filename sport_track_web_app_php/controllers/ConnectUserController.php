<?php
//Lisa Le Goff Mauvoisin | Thomas Poulain - 2A

require_once('Controller.php');
require_once('./model/User.php');
require_once('./model/UserDAO.php');

/**
 * Controller de connexion d'un utilisateur
 */
class ConnectUserController implements Controller{

    public function handle($request){

        if(isset($_POST['login-submit'])){

        
            //Déjà connecté ?
            if(isset($_SESSION['email'])){
                $_SERVER['message'] = '<p>Vous êtes déjà connecté</p>';
                header("Refresh:0");
            }
            else{
                $email = $_POST['emailA'];
                $pwd = $_POST['pwd']; 

                $usrDAO = UserDAO::getInstance();
                $usr = $usrDAO->find($email);


                if (isset($usr) && !empty($usr)){
                    if (($pwd== $usr['pwd'])) {
                        //Mot de passe correct
                        $_SESSION['email'] = $usr['email'];
                        $_SESSION['idUser'] = $usr['idUser'];
                        $_SESSION['lName'] = $usr['lName'];
                        $_SESSION['fName'] = $usr['fName'];
                        $_SESSION['birthday'] = $usr['birthday'];
                        $_SESSION['sexe'] = $usr['sexe'];
                        $_SESSION['height'] = $usr['height'];
                        $_SESSION['weight'] = $usr['weight'];
                        
                        $_SESSION['message'] = '<p>Vous êtes connecté</p>';
                        header("Refresh:0");
                    }
                    else {
                        $_SESSION['message'] = '<p>E-mail ou mot de passe invalide</p>';
                        header("Refresh:0");
                    }
                }else {
                    $_SESSION['message'] ='<p>E-mail ou mot de passe invalide</p>';
                    header("Refresh:0");
                }
            }
        }
    }

}
?>

