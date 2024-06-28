<?php 

try{
    $connexion=new PDO('mysql:host=localhost;dbname=ventes','root','');
}
catch(PDOException $ex){
    echo "erreur lors de la connexion".$ex->getMessage();
    die();
}

?>