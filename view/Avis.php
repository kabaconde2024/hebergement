<?php 
include('Layout.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos avis</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Exemple de style CSS pour la page */
body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.form-container {
    position: relative;
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.background-image {
    position: absolute;
    top: -20px; /* Ajustez la position verticale selon vos besoins */
    left: -20px; /* Ajustez la position horizontale selon vos besoins */
    width: 100%;
    max-width: calc(100% + 40px); /* Ajustez la largeur pour inclure le débordement à gauche et à droite */
    z-index: -1;
}

form label {
    display: block;
    margin-bottom: 5px;
}

form textarea,
form input[type="text"] {
    width: calc(100% - 20px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form textarea {
    height: 100px;
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
    <h1>Vos avis</h1>
    <div class="form-container">
        <img src="formulaires.png" alt="Image descriptive" class="background-image">
        <form action="https://forms.gle/your-google-form-link" method="post" target="_blank">
            <label for="experience">1. Quelle est votre expérience globale sur notre plateforme ?</label><br>
            <textarea id="experience" name="experience" required></textarea><br>
            
            <label for="aspects">2. Quels aspects de notre site appréciez-vous le plus ?</label><br>
            <textarea id="aspects" name="aspects" required></textarea><br>
            
            <label for="ameliorer">3. Comment pourrions-nous améliorer votre expérience sur notre site ?</label><br>
            <textarea id="ameliorer" name="ameliorer" required></textarea><br>
            
            <label for="suggestions">4. Avez-vous des suggestions pour de nouvelles fonctionnalités que nous pourrions ajouter ?</label><br>
            <textarea id="suggestions" name="suggestions" required></textarea><br>
            
            <label for="difficultes">5. Avez-vous rencontré des difficultés lors de l'utilisation de notre plateforme ? Si oui, lesquelles ?</label><br>
            <textarea id="difficultes" name="difficultes" required></textarea><br>
            
            <label for="nouveaux">6. Quel type d'articles ou de services souhaiteriez-vous voir ajouté à notre plateforme ?</label><br>
            <textarea id="nouveaux" name="nouveaux" required></textarea><br>
            
            <input type="submit" value="Soumettre votre avis">
        </form>
    </div>
</body>
</html>
