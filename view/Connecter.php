<?php
include('Layout.php');
include('../config/Connexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['passwords']) ? $_POST['passwords'] : '';

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM utilisateur WHERE email = :email AND passwords = :password";
        $resultat = $connexion->prepare($sql);
        $resultat->bindValue(':email', $email, PDO::PARAM_STR);
        $resultat->bindValue(':password', $password, PDO::PARAM_STR);
        $resultat->execute();
        $user = $resultat->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Utilisateur trouvé, enregistrez les informations de session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];

            // Redirection vers la page de profil
            header('Location: /view/Profile.php');
            exit();
        } else {
            // Utilisateur non trouvé, afficher un message d'erreur ou traiter autrement
            echo "Identifiants incorrects. Veuillez réessayer.";
        }
    } else {
        // Gérer le cas où les champs sont vides
        echo "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Styles spécifiques pour la page de connexion */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

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
    </style>
</head>
<body>
    <form action="Connecter.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="passwords" required><br>
        <input type="submit" value="Se Connecter">
    </form>
</body>
</html>
