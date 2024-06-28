<?php
include('Layout.php');
include('../config/Connexion.php');

// Initialisation de $term avec une chaîne vide par défaut
$term = isset($_GET['term']) ? $_GET['term'] : '';

$sql = "SELECT * FROM Annonce ORDER BY date_creation DESC";
$resultat = $connexion->prepare($sql);
$resultat->execute();
$annonces = $resultat->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Annonces</title>
    <link rel="stylesheet" href="Accueil.css">
    <style>
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            display: flex;
        }
        .vertical-menu {
            width: 170px; /* Largeur fixe du menu vertical */
            padding: 20px;
            background-color: #f2f2f2;
        }
        .container {
            flex: 1; /* Le conteneur principal prend le reste de l'espace disponible */
            max-width: 1000px;
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
            margin-top: 2px;
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
</head>
<body>
    <div class="wrapper">
        <div class="vertical-menu">
            <a href="#" class="active">Categories</a>
            <a href="/view/Informatique.php"><img src="images/informatique.jpg" alt="Informatique"> Informatique</a>
            <a href="/view/Immobilier.php"><img src="images/immobilier.jpg" alt="Immobilier"> Immobilier</a>
            <a href="/view/Musique.php"><img src="images/musique.jpg" alt="Musique"> Musique</a>
            <a href="/view/Sport.php"><img src="images/sport.jpg" alt="Sport"> Sport</a>
        </div>
        
        <div class="container">
              <!-- Formulaire de recherche -->
              <form id="searchForm" class="search-box" method="GET">
                <input type="text" id="searchTerm" name="term" placeholder="Rechercher par nom ou adresse..." value="<?php echo htmlspecialchars($term); ?>">
                <!-- Pas besoin d'un bouton de soumission pour la recherche dynamique -->
            </form>
            <h1>Liste des Annonces</h1>

        

            <div class="grid-container" id="annoncesContainer">
                <?php foreach ($annonces as $annonce): ?>
                    <div class="annonce">
                        <img src="../uploads/<?php echo htmlspecialchars($annonce['images']); ?>" alt="<?php echo htmlspecialchars($annonce['nom'] ?? ''); ?>">
                        <div class="annonce-details">
                            <p><strong>Nom:</strong> <?php echo htmlspecialchars($annonce['nom'] ?? ''); ?></p>
                            <p><strong>Quantité:</strong> <?php echo $annonce['quantite']; ?></p>
                            <p><strong>Prix:</strong> <?php echo $annonce['prix']; ?></p>
                            <p><strong>Adresse:</strong> <?php echo htmlspecialchars($annonce['adresse'] ?? ''); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        // Sélection des éléments DOM
        const searchForm = document.getElementById('searchForm');
        const searchTermInput = document.getElementById('searchTerm');
        const annoncesContainer = document.getElementById('annoncesContainer');
        const annonces = <?php echo json_encode($annonces); ?>;

        // Fonction pour filtrer les annonces
        function filterAnnonces(term) {
            const filteredAnnonces = annonces.filter(annonce => {
                const nom = annonce.nom.toLowerCase();
                const adresse = annonce.adresse.toLowerCase();
                return nom.includes(term) || adresse.includes(term);
            });

            // Générer le HTML des annonces filtrées
            const html = filteredAnnonces.map(annonce => `
                <div class="annonce">
                    <img src="../uploads/${annonce.images}" alt="${annonce.nom}">
                    <div class="annonce-details">
                        <p><strong>Nom:</strong> ${annonce.nom}</p>
                        <p><strong>Quantité:</strong> ${annonce.quantite}</p>
                        <p><strong>Prix:</strong> ${annonce.prix}</p>
                        <p><strong>Adresse:</strong> ${annonce.adresse}</p>
                    </div>
                </div>
            `).join('');

            // Mettre à jour le contenu de la grille d'annonces
            annoncesContainer.innerHTML = html;
        }

        // Écouter les événements de saisie dans le champ de recherche
        searchTermInput.addEventListener('input', function() {
            const term = this.value.trim().toLowerCase();
            filterAnnonces(term);
        });

        // Initialiser la page avec toutes les annonces au chargement
        filterAnnonces('<?php echo htmlspecialchars($term); ?>');
    </script>
</body>
</html>
