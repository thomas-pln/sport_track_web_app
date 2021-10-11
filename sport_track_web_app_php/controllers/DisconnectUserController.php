<?php
//Lisa Le Goff Mauvoisin | Thomas Poulain - 2A

require('Controller.php');

/**
 * Controller de déconnexion
 */
class DisconnectUserController implements Controller{

    public function handle($request){
        //Supprime la donnée de _SESSION ce qui déconnecte de toutes les pages
        unset($_SESSION['email']);

        //Supprime la variable _SESSION
        session_destroy();

        //On refresh la page pour appliquer la déconnexion
        header("Refresh:0");
        $_SESSION['message'] = 'Vous avez été déconnecté';
        header("Location: index.php?page=user_connect_form");

    }

}
?>