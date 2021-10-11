<!DOCTYPE html>
<html lang ="fr"> 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Deconnexion</title>
</head>
<body>
  <?php include('views/navBar.php') ?>

  <div class="activity-div">
    <?php
    echo  $_SESSION['message'];
    ?>
    </div>

</body>
</html>
