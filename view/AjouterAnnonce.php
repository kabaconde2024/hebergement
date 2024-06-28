<?php
include('Layout.php');
include('../config/Connexion.php');

// Vérification de session
if (!isset($_SESSION['user_id'])) {
    // Redirection vers la page d'inscription si l'utilisateur n'est pas connecté
    header('Location: /view/Inscription.php');
    exit;
}

// Traitement du formulaire d'ajout d'annonce
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : null;
    $prix = isset($_POST['prix']) ? $_POST['prix'] : null;
    $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : '';
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    $images = isset($_FILES['images']) ? $_FILES['images'] : '';

    // Emplacement de sauvegarde des images
    $upload_directory = '../uploads/';

    // Nom du fichier d'image téléchargé
    $image_name = basename($images['name']);

    // Chemin complet pour sauvegarder l'image
    $target_path = $upload_directory . $image_name;

    // Récupérer l'ID de l'utilisateur connecté
    $user_id = $_SESSION['user_id'];

    try {
        $sql = "INSERT INTO Annonce (nom, quantite, prix, adresse, categorie, images, userId) 
                VALUES (:nom, :quantite, :prix, :adresse, :categorie, :image_name, :user_id)";
        $resultat = $connexion->prepare($sql);
        $resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
        $resultat->bindValue(':quantite', $quantite, PDO::PARAM_INT);
        $resultat->bindValue(':prix', $prix, PDO::PARAM_INT);
        $resultat->bindValue(':adresse', $adresse, PDO::PARAM_STR);
        $resultat->bindValue(':categorie', $categorie, PDO::PARAM_STR);
        $resultat->bindValue(':image_name', $image_name, PDO::PARAM_STR);
        $resultat->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        
        if ($resultat->execute()) {
            // Déplacer l'image vers le répertoire d'uploads
            if (move_uploaded_file($images['tmp_name'], $target_path)) {
                echo "Annonce créée avec succès";
                header('Location: /view/AjouterAnnonce.php'); // Redirection après l'insertion réussie
                exit;
            } else {
                echo "Erreur lors de l'envoi de l'image";
            }
        } else {
            echo "Erreur lors de la création de l'annonce";
        }
    } catch(PDOException $ex) {
        echo "Erreur SQL lors de l'insertion de l'annonce: " . $ex->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Annonce</title>
</head>
<body>
<div style="max-width: 800px; margin: auto; margin-top: 50px; padding: 20px; border: 1px solid #ccc; border-radius: 5px;">
  <h1 style="text-align: center; margin-bottom: 20px;">Créer une Annonce</h1>
  <form action="AjouterAnnonce.php" method="POST" enctype="multipart/form-data">
    <div style="margin-bottom: 10px;">
      <label for="nom">Nom:</label>
      <input type="text" id="nom" name="nom" value="" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;" required />
    </div>
    <div style="margin-bottom: 10px;">
      <label for="quantite">Quantité:</label>
      <input type="number" id="quantite" name="quantite" value="" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;" />
    </div>
    <div style="margin-bottom: 10px;">
      <label for="prix">Prix:</label>
      <input type="number" id="prix" name="prix" value="" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;" />
    </div>
    <div style="margin-bottom: 10px;">
      <label for="adresse">Adresse:</label>
      <input type="text" id="adresse" name="adresse" value="" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;" required />
    </div>
    <div style="margin-bottom: 10px;">
      <label for="categorie">Catégorie:</label>
      <select id="categorie" name="categorie" style="width: 100%; padding: 8px; border-radius: 5px; border: 1px solid #ccc;" required>
        <option value="">Sélectionnez une catégorie</option>
        <option value="informatique">Informatique</option>
        <option value="immobilier">Immobilier</option>
        <option value="musique">Musique</option>
        <option value="sport">Sport</option>
      </select>
    </div>
   
    <div style="margin-bottom: 10px;">
      <label for="images">Image:</label>
      <input type="file" id="images" name="images" style="display: none;" />
      <label for="image" style="background-color: #007bff; color: #fff; padding: 8px 20px; border-radius: 5px; border: none; cursor: pointer;">Choisir un fichier</label>
      <span id="selectedFileName"></span>
    </div>

    <button type="submit" style="background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer; width: 100%;">Créer Annonce</button>
  </form>
</div>

</body>
</html>
