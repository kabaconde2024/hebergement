<?php 
include('../config/Connexion.php');

try {
    $sql = "CREATE TABLE IF NOT EXISTS Utilisateur (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        numero INT,
        passwords VARCHAR(30) NOT NULL,
        confirmPassword VARCHAR(30) NOT NULL
    )";
    
    $connexion->exec($sql);
    echo "Table Utilisateur créée avec succès ou déjà existante";
} catch(PDOException $ex) {
    echo "Erreur lors de la création de la table Utilisateur: " . $ex->getMessage();
    die();
}
?>
