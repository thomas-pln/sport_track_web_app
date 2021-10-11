<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Créer un compte</title>
</head>
<body class='backgroundImg'>
    <?php include('views/navBar.php') ?>

    <div class="form-div">

    <div class="form-content">
    <form method="POST" enctype="multipart/form-data" name="register">

        <p class="form-title">S'enregistrer</p>

        <input type="text" id="fname" name="fname" required placeholder="Nom*"><br>

        <input type="text" id="lname" name="lname" required placeholder="Prénom*"><br>

        <input type="email" id="emailA" name="emailA" required placeholder="Email*"><br>
        <?php if(isset($_SESSION['errMail'])){
            echo $_SESSION['errMail'];
        } ?>

        <div class="group-input-section">
            <p>Date de naissance</p>
            <input class="input-nomarge" type="date" id="birthday" name="birthday" required>
        </div>


        <div class="group-input-section">
            <label>Sexe:</label>
            <label>
                <input class="input-nomarge" type="radio" name="gender" value="H" required>Homme
            </label>
            <label>
                <input class="input-nomarge" type="radio" name="gender" value="F">Femme
            </label>
            <label>
                <input class="input-nomarge" type="radio" name="gender" value="A">Autre
            </label>
        </div>

        <div class="group-input-section">
            <p>Taille en cm</p>
            <input class="input-nomarge" type="number" id="height" name="height" min="1" step="1" required><br>
            <?php if(isset($_SESSION['errTaille'])){
                echo $_SESSION['errTaille'];
            } ?>
        </div>

        <div class="group-input-section">
            <p>Poids en kg</p>
            <input class="input-nomarge" type="number" id="weight" name="weight" min="1" step="1" required><br>
            <?php if(isset($_SESSION['errPoids'])){
                echo $_SESSION['errPoids'];
            } ?>
        </div>

        <div class="group-input-section">
            <input class="input-nomarge" type="password" id="pwd" name="pwd" minlength="8" required placeholder="Mot de passe"><br>
            <p>8 caratères minimum</p>
        </div>

        <input class="btn" type="submit" value="Valider" name="register-submit">
      </form>
      <?php if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
      }?>
      </div>
      </div>


</body>
</html>
