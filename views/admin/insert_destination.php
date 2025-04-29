<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $nom = $_POST['nom'];
        $pays = $_POST['pays'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];

        // Prepare and execute the insert query
        $query = $conn->prepare("INSERT INTO destinations (nom, pays, description, prix) VALUES (?, ?, ?, ?)");
        $result = $query->execute([$nom, $pays, $description, $prix]);

        if ($result) {
            // Redirect back to the destinations list with success message
            header("Location: affichdes.php?add_success=1");
            exit();
        } else {
            // Redirect back with error message
            header("Location: affichdes.php?add_error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error and redirect with error message
        error_log("Error adding destination: " . $e->getMessage());
        header("Location: affichdes.php?add_error=1");
        exit();
    }
} else {
    // If not a POST request, redirect to the destinations list
    header("Location: affichdes.php");
    exit();
}
?> 