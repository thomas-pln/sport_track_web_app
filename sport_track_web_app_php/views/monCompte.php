<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="./connexion.html">Se Connecter</a></li>
            <li><a href="./monCompte.html">Mes Informations</a></li>
            <li><a href="./signIn.html">Créer un compte</a></li>
            <li><a href="./depotActivite.html">Importer une activité</a></li>
        </ul>
    </nav>

    <h1>Mes Informations / Modifier mes Informations</h1>

    <form action="/modifyInfo.php" enctype="multipart/form-data">
        <label for="fname">Nom: </label>
        <input type="text" id="fname" name="fname" required><br>
        
        <label for="lname">Prénom: </label>
        <input type="text" id="lname" name="lname" required><br>

        <label for="birthday">Date de naissance: </label>
        <input type="date" id="birthday" name="birthday" required><br>

        <div>
            <label>Sexe: </label><br>
            <label>
                <input type="radio" name="gender" value="H" required>Homme
            </label>
            <label>
                <input type="radio" name="gender" value="F">Femme
            </label>
            <label>
                <input type="radio" name="gender" value="A">Autre
            </label>
        </div>

        <label for="height">Taille</label>
        <input type="number" id="height" name="height" min="0" step="1" required><br>

        <label for="weight">Poids</label>
        <input type="number" id="weight" name="weight" min="0" step="1" required><br>

        <label for="emailA">Adresse électronique</label><br>
        <input type="email" id="emailA" name="emailA" required><br>

        <label for="pwd">Mot de passe (8 caratères minimum)</label><br>
        <input type="password" id="pwd" name="pwd" minlength="8" required><br>
        
        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>