<?php 
include('Layout.php');
include('../config/Connexion.php');

// Initialisation du terme de recherche
$term = isset($_GET['term']) ? $_GET['term'] : '';

// Requête SQL pour récupérer les annonces avec filtre par terme de recherche
$sql = "SELECT * FROM Annonce";

// Ajout du filtre par terme de recherche si un terme est spécifié
if (!empty($term)) {
    $sql .= " WHERE nom LIKE :term OR adresse LIKE :term";
}

$resultat = $connexion->prepare($sql);

// Liaison du paramètre de terme de recherche si nécessaire
if (!empty($term)) {
    $searchTerm = '%' . $term . '%';
    $resultat->bindParam(':term', $searchTerm, PDO::PARAM_STR);
}

$resultat->execute();
$annonces = $resultat->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Annonces</title>
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

        /* Styles pour la boîte de recherche */
        .search-box {
            margin-bottom: 20px;
            text-align: center;
        }
        .search-box input[type="text"] {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-box input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchBox = document.querySelector('.search-box input[type="text"]');
            const gridContainer = document.querySelector('.grid-container');
            const annonces = <?php echo json_encode($annonces); ?>;

            searchBox.addEventListener('input', function() {
                const term = this.value.toLowerCase().trim();
                let output = '';
                annonces.forEach(function(annonce) {
                    const nom = annonce.nom.toLowerCase();
                    const adresse = annonce.adresse.toLowerCase();
                    if (nom.includes(term) || adresse.includes(term)) {
                        output += `
                            <div class="annonce">
                                <img src="../uploads/${annonce.images}" alt="${annonce.nom}">
                                <div class="annonce-details">
                                    <p><strong>Nom:</strong> ${annonce.nom}</p>
                                    <p><strong>Quantité:</strong> ${annonce.quantite}</p>
                                    <p><strong>Prix:</strong> ${annonce.prix}</p>
                                    <p><strong>Adresse:</strong> ${annonce.adresse}</p>
                                </div>
                            </div>
                        `;
                    }
                });
                gridContainer.innerHTML = output;
            });
        });
    </script>
</head>
<body>
    <div class="container">
    <form action="" method="GET" class="search-box">
            <input type="text" name="term" placeholder="Rechercher par nom ou adresse..." value="<?php echo htmlspecialchars($term); ?>">
            <input type="submit" value="Rechercher">
        </form>
        <h1>Liste des Annonces</h1>

        <!-- Formulaire de recherche -->
       

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
