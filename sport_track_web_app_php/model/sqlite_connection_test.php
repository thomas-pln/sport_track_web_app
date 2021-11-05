<?php

    require('model/User.php');
    require('model/UserDAO.php');

    $UserDAO =  UserDAO::getInstance();

    echo "Table vide ?";
    var_dump($UserDAO->findAll());

    $UserDAO->purge();

    echo 'Table vidée';
    var_dump($UserDAO->findAll());

    $aUser = new User();
    $aUser->init(8,'Dupont', 'Jean', '01/01/2000', 'H', 170, 60, 'Jean.Dupont@mail.com', 'fbdfbdfbdfv');

    $UserDAO->insert($aUser);

    echo 'Nouvelle entrée';
    var_dump($UserDAO->findAll());


    $UserDAO->delete($aUser);

    echo 'User inséré supprimé';
    var_dump($UserDAO->findAll());

?> 