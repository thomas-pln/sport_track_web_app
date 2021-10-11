<!DOCTYPE html>
<html lang ="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Depot fichier nouvelle activite</title>
</head> 
<body class="backgroundImg">
  <?php include('views/navBar.php') ?>

  <div class="form-div">
    <div class="form-content">
      <form method="POST" enctype="multipart/form-data">
        <div class="group-input-section">
          <p>Dépose ci-dessous une activité: </p>
          <input class="input-nomarge" type="file" id="avatar" name="actFile" accept=".json" required><br><br>
        <div>
        <input class="btn" type="submit" value="Valider" name="uploadAct-submit">
      </form>
    </div>
    <?php if(isset($_SESSION['messageFile'])) echo $_SESSION['messageFile']; ?>
  </div>
  

</body>
</html>
