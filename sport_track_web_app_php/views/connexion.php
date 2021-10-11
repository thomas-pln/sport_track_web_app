<!DOCTYPE html>
<html lang ="fr"> 
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Connexion</title>
</head>
<body class='backgroundImg'>
  <?php include('views/navBar.php') ?>

<div class="form-div">
  <div class="form-content">
    <p class="form-title">Se Connecter</p>
    <form method="POST">
      <div class="group-input-section">
        <p>Adresse électronique</p>
        <input class="input-nomarge" type="email" id="emailA" name="emailA" required>
      </div>
      <div class="group-input-section">
        <p>Mot de passe</p>
        <input class="input-nomarge" type="password" id="pwd" name="pwd" required>
      </div> 
    <input class="input-nomarge btn" type="submit" value="Se connecter" name="login-submit">
  </form> 

  <?php if(isset($_SESSION['message'])){
              echo $_SESSION['message'];}
?>
  </div>
</div>

</body>
</html>
