<?php 
include('Layout.php');
include('../config/Connexion.php');

// Filtrage par catégorie 'informatique'
$sql = "SELECT * FROM Annonce WHERE categorie = 'sport'";
$resultat = $connexion->prepare($sql);
$resultat->execute();
$annonces = $resultat->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Annonces Informatique</title>
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .annonce {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            height: 350px; /* Hauteur fixe du conteneur de l'annonce */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .annonce img {
            max-width: 100%;
            height: 200px; /* Hauteur fixe de l'image à l'intérieur de l'annonce */
            object-fit: cover; /* Pour s'assurer que l'image remplit l'espace disponible sans déformation */
            border-radius: 5px;
        }
        .annonce-details {
            margin-top: 10px;
        }
        .annonce-details p {
            margin: 5px 0;
        }

        /* Pour afficher trois annonces par ligne */
        @media (min-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(3, 1fr); /* Trois colonnes par ligne */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Annonces Sport</h1>
        <div class="grid-container">
            <?php foreach ($annonces as $annonce): ?>
                <div class="annonce">
                    <img src="../uploads/<?php echo htmlspecialchars($annonce['images']); ?>" alt="<?php echo htmlspecialchars($annonce['nom']); ?>">
                    <div class="annonce-details">
                        <p><strong>Nom:</strong> <?php echo htmlspecialchars($annonce['nom']); ?></p>
                        <p><strong>Quantité:</strong> <?php echo $annonce['quantite']; ?></p>
                        <p><strong>Prix:</strong> <?php echo $annonce['prix']; ?></p>
                        <p><strong>Adresse:</strong> <?php echo htmlspecialchars($annonce['adresse']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
