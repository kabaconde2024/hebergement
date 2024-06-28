<?php 
include('../config/Connexion.php');

try {
    $sql = "CREATE TABLE IF NOT EXISTS Annonce (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(30) NOT NULL,
        quantite INT,
        prix INT,
        categorie ENUM('informatique','immobilier','musique','sport') NOT NULL,
        adresse VARCHAR(30) NOT NULL,
        images VARCHAR(250),
        userId INT UNSIGNED,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (userId) REFERENCES Utilisateur(id)
    )";
    
    $connexion->exec($sql);
   // echo "Table Annonce créée avec succès ou déjà existante";
} catch(PDOException $ex) {
    echo "Erreur lors de la création de la table Annonce: " . $ex->getMessage();
    die();
}
?>
