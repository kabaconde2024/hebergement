<?php
include('Layout.php');
include('../config/Connexion.php');

// Vérifie si l'utilisateur est connecté avant de récupérer les données
if (!isset($_SESSION['user_id'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: /view/Connexion.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Requête pour récupérer les informations de l'utilisateur
$sql = "SELECT * FROM utilisateur WHERE id = :user_id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifie si l'utilisateur existe
if (!$user) {
    // Redirection vers une page d'erreur ou une autre action appropriée
    header('Location: /view/Erreur.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?php echo htmlspecialchars($user['nom']); ?></title>
    <style>
   
   .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: aqua;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 35px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
        .profile-item {
            margin-bottom: 15px;
        }
        .profile-item strong {
            color: #333;
        }
        .profile-item span {
            display: block;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenue <?php echo htmlspecialchars($user['nom']); ?></h1>
        <div class="profile-item">
            <p><strong>Email :</strong> <span><?php echo htmlspecialchars($user['email']); ?></span></p>
        </div>
    
    </div>
</body>
</html>
