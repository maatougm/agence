<?php

include '../../config/connexion.php';


$id=$_POST['id'];
$nom=$_POST['nom'];

$email=$_POST['email'];


// Préparer la requête de modification
$sql = "UPDATE personne
SET nom = '$nom', 
    email = '$email'
    
WHERE id = $id";

$reponse = $conn->exec($sql);

header('location:afficherpersonnes4.php')

?>