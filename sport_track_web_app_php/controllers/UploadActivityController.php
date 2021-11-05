<?php

    require_once('Controller.php');
    require_once('./model/Activity.php');
    require_once('./model/ActivityDAO.php');
    require_once('./model/Data.php');
    require_once('./model/ActivityEntryDAO.php');
    require_once('./model/CalculDistanceImpl.php');

    /**
     * Controller d'ajout d'une activité et des données
     */
    class UploadActivityController implements Controller{
        public function handle($request){
            //L'utilisateur est connecté ?
            if(isset($_SESSION['email'])){

                //Est-ce qu'un fichier a été envoyé (correctement) ?
                if(isset($_FILES['actFile']) && $_FILES['actFile']['error']==0){
                    $this->processFile();
                }
            }else{
                $_SESSION['message'] = "Vous devez être connecté.e pour importer une activité.";
                header("Location: index.php?page=user_connect_form"); //Redirection page de connexion
            }
        }

        /**
         * Vérifie l'intégrité/compatibilité du fichier et le traite
         */
        private function processFile(){
            $fileInfos = pathinfo($_FILES['actFile']['name']);

            //On vérifie que c'est bien un json
            if(strcmp($fileInfos['extension'], 'json')==0){
                $json = file_get_contents($_FILES['actFile']['tmp_name']);
                $json_content = json_decode($json, true);

                //Le fichiers contient bien les informations requises
                if(isset($json_content['activity']['date']) && !empty($json_content['activity']['date']) && isset($json_content['activity']['description']) && !empty($json_content['activity']['description']) && isset($json_content['data']) && !empty($json_content['data'])){

                    $calculDist = new CalculDistanceImpl();
                    $dist = $calculDist->calculDistanceTrajet($json_content['data']);

                    $startAt = $json_content['data'][0]['time'];
                    $endAt = $json_content['data'][sizeof($json_content['data'])-1]['time'];

                    $start = new \DateTime($startAt);
                    $end = new \DateTime($endAt);
        
                    $diff = $start->diff($end);
                    $diffStr = $diff->format('%H:%I:%S');

                    $fileName = explode(".", $_FILES['actFile']['name']);

                    $activityObj = new Activity();
                    $activityObj->init($fileName[0], $json_content['activity']['date'], htmlspecialchars($json_content['activity']['description']), $dist, $diffStr, $json_content['data'][0]['time'], null, null, null, $_SESSION['idUser']);

                    //Try catch si l'activité existe déjà
                    try{
                        ActivityDAO::getInstance()->insert($activityObj); //Insère l'activité dans la bdd

                        $ActivityEntryDAO = ActivityEntryDAO::getInstance();

                        $idx = 0;
                        //Insère toutes les donnée dans la bdd
                        while($idx < sizeof($json_content['data'])){
                            $data = new Data();
                            $data->init(null, $json_content['data'][$idx]['time'], $json_content['data'][$idx]['cardio_frequency'], $json_content['data'][$idx]['latitude'], $json_content['data'][$idx]['longitude'], $json_content['data'][$idx]['altitude'], $fileName[0]);
                            $ActivityEntryDAO->insert($data);
                            $idx++;
                        }
                    }catch(PDOException $e){
                    $_SESSION["messageFile"]="Activité déjà importée";
                    }

                }else{
                    $_SESSION["messageFile"]="Le fichier est incomplet";
                }

            }else{
                $_SESSION['messageFile']="Seuls les fichiers JSON sont autrisés";
            }


        }
    }