<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $numtel = $_POST['numtel'];

        // Prepare and execute the insert query
        $query = $conn->prepare("INSERT INTO client (nom, prenom, email, numtel) VALUES (?, ?, ?, ?)");
        $result = $query->execute([$nom, $prenom, $email, $numtel]);

        if ($result) {
            // Redirect back to the client list with success message
            header("Location: afficher.php?add_success=1");
            exit();
        } else {
            // Redirect back with error message
            header("Location: afficher.php?add_error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error and redirect with error message
        error_log("Error adding client: " . $e->getMessage());
        header("Location: afficher.php?add_error=1");
        exit();
    }
} else {
    // If not a POST request, redirect to the client list
    header("Location: afficher.php");
    exit();
}
?>