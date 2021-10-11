<!DOCTYPE html>
<html lang ="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Mes activités</title>
</head> 
<body class='backgroundImg'>
  <?php include('views/navBar.php') ?>
    <?php
        if(!empty($_SESSION['activity']) && isset($_SESSION)){

            echo "<div class='infos'>";
            echo    "<span><p class='info'>Nom: ".$_SESSION['lName']."</p>";
            echo    "<p class='info'>Prénom: ".$_SESSION['fName'] ."</p>";
            echo    "<p class='info'>email: ".$_SESSION['email']."</p>";
            echo    "<p class='info'>Date de naissance: ".$_SESSION['birthday']."</p>";
            echo    "<p class='info'>Sexe: ".$_SESSION['sexe']."</p>";
            echo    "<p class='info'>Taille: ".$_SESSION['height']."</p>";
            echo    "<p class='info'>Poids: ".$_SESSION['weight']."</p></span>";
            echo "</div>";


            echo "<div class='activity-div'>";
            echo "<table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Distance (en km)</th>
                        <th>Temps</th>
                        <th>Commencé à</th>
                        <th>Fréquence min</th>
                        <th>Fréquence moy</th>
                        <th>Fréquence max</th>
                    </tr>
                </thead>";
                foreach($_SESSION['activity'] as $activity){
                echo    "<tbody>
                        <tr>
                            <td>".$activity->getIdAct()."</td>
                            <td>".$activity->getDate()."</td>
                            <td>".$activity->getDescription()."</td>
                            <td>".$activity->getDistance()."</td>
                            <td>".$activity->getTotalTime()."</td>
                            <td>".$activity->getStartTime()."</td>
                            <td>".$activity->getFreqMin()."</td>
                            <td>".$activity->getFreqMoy()."</td>
                            <td>".$activity->getFreqMax()."</td>
                        </tr>
                    </tbody>";
                }
            echo "</table>";
            echo "</div>";

        }elseif(isset($_SESSION) && empty($_SESSION[`activity`])){
            echo "<p>Vous n`avez pas encore importé d`activité";   
        }else{
            echo `<p>Vous devez être connecté.e <p>`; 
        }
    ?>
    
    </div>
</body>
</html>
