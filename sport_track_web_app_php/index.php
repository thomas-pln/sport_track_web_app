<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    
    if(!isset($_SESSION)){session_start();} 
    
    require_once 'controllers/ApplicationController.php';

    if(!isset ($_REQUEST['page'])){
        $_REQUEST['page'] = '/';
    }
    $controller = ApplicationController::getInstance()->getController($_REQUEST);
    if($controller != null){
        include "controllers/$controller.php";
        (new $controller())->handle($_REQUEST);
    }

    $view = ApplicationController::getInstance()->getView($_REQUEST);
    if($view != null){
        include "views/$view.php";
    }

?>