<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Layout.css">
</head>
<body>

<div class="navbar">
    <a href="/view/Accueil.php">Accueil</a>
    <a href="/view/Annonce.php">Annonces</a>
    <a href="/view/Boutique.php">Boutiques</a>
    <a href="/view/Propos.php">A propos</a>
    <a href="/view/Test.php"> Test</a>
    <a href="https://docs.google.com/forms/d/e/1FAIpQLSdh9Ua3OXN_1JMKqsxYELqMJWpOkjcAaAbl3RAX4EQhKpa20Q/viewform">Vos avis</a>

    <?php
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['user_id']) && isset($_SESSION['nom'])) {
        echo '<div class="dropdown">';
        echo '<a href="/view/Profile.php"><button class="dropbtn">Profil</button></a>';
        echo '<div class="dropdown-content">';
        echo '<a href="#">' . htmlspecialchars($_SESSION['nom']) . '</a>';
        echo '<a href="/view/MesAnnonces.php">Mes annonces</a>';
        echo '<a href="/view/Deconnexion.php">Se déconnecter</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<a class="btn" href="/view/Inscription.php">S\'inscrire</a>';
    }
    ?>

    <a class="btn" href="/view/AjouterAnnonce.php">Ajouter Annonce</a>
</div>

</body>
</html>
