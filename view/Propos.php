<?php 

include('Layout.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos</title>
    <style>
        /* Exemple de style CSS pour le corps de la page */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            line-height: 1.6;
        }

        .company-info {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }

        .company-info p {
            font-size: 14px;
        }

        /* Style pour l'image */
        .about-section {
            display: flex;
            align-items: center; /* Alignement vertical */
        }

        .about-section img {
            max-width: 450px; /* Taille maximale de l'image */
            margin-right: 20px; /* Marge à droite de l'image */
        }
    </style>
</head>
<body>
    <h1>À propos de notre site</h1>

    <div class="about-section">
        <img src="marque.jpg" alt="Image descriptive">
        <div>
            <p>Notre site vous propose une plateforme pour gérer des annonces et des boutiques en ligne.</p>
            <p>Nous visons à fournir une expérience utilisateur simple et efficace pour acheter et vendre en ligne.</p>
        </div>
    </div>

    <div class="company-info">
        <h2>Informations sur notre société</h2>
        <p>Nom de la société : Votre Nom de Société</p>
        <p>Adresse : Adresse de votre société</p>
        <p>Numéro de téléphone : Numéro de téléphone de votre société</p>
    </div>
</body>
</html>
