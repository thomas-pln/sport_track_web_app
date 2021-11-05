<?php

require_once ('Controller.php');
require_once('./model/ActivityDAO.php');

/**
 * Controller permettant de lister les activités d'un utilisateur
 */
class ListActivityController implements Controller{

    public function handle($request){
        
        if(isset($_SESSION['email'])){
            //Envoie dans _SESSION le tableau contenant toutes les activités de l'utilisateur de le session courante
            $activity = ActivityDAO::getInstance();

            $_SESSION['activity'] = $activity->findAllUser($_SESSION['idUser']);
        }else{
            $_SESSION['message'] = "Vous devez être connecté.e pour voir vos activités";
            header("Location: index.php?page=user_connect_form"); //Redirection page de connexion
        }

    }
}

?>