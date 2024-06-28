<?php 
include('Layout.php');
include('../config/Connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $passwords = isset($_POST['passwords']) ? $_POST['passwords'] : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';


    $sql="INSERT INTO utilisateur (nom, email, passwords, confirmPassword) VALUES (:nom, :email, :passwords, :confirmPassword)";
    $resultat = $connexion->prepare($sql);
    $resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
    $resultat->bindValue(':email', $email, PDO::PARAM_STR);
    $resultat->bindValue(':passwords', $passwords, PDO::PARAM_STR);
    $resultat->bindValue(':confirmPassword', $confirmPassword, PDO::PARAM_STR);
    $resultat->execute();
    header('Location: /view/Inscription.php'); // Redirection après l'insertion réussie
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        /* Styles spécifiques pour le formulaire d'inscription */
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 70px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Réinitialisation des styles pour le layout général */
        .container,
        .grid-container,
        .annonce,
        .annonce img,
        .annonce-details,
        .annonce-details p {
            margin: 0;
            padding: 0;
            border: none;
            background: none;
            width: auto;
            max-width: none;
            height: auto;
            max-height: none;
            display: block;
            float: none;
            clear: none;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #000;
        }
    </style>
</head>
<body>
    <form action="Inscription.php" method="post">
        <label for="nom">Nom d'utilisateur:</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="passwords" required><br>
        <label for="confirmPassword">Mot de passe de confirmation:</label><br>
        <input type="password" id="confirmPassword" name="confirmPassword" required><br>
        <input type="submit" value="S'inscrire">
        <p>Déjà inscrit? <a href="/view/Connecter.php">Se connecter</a></p>

    </form>

    <!-- Lien pour se connecter -->
</body>
</html>

