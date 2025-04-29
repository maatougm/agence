<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $id_client = $_POST['id_client'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $numtel = $_POST['numtel'];

        // Prepare and execute the update query
        $query = $conn->prepare("UPDATE client SET nom = ?, prenom = ?, email = ?, numtel = ? WHERE id_client = ?");
        $result = $query->execute([$nom, $prenom, $email, $numtel, $id_client]);

        if ($result) {
            // Redirect back to the client list with success message
            header("Location: afficher.php?success=1");
            exit();
        } else {
            // Redirect back with error message
            header("Location: afficher.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error and redirect with error message
        error_log("Error updating client: " . $e->getMessage());
        header("Location: afficher.php?error=1");
        exit();
    }
} else {
    // If not a POST request, redirect to the client list
    header("Location: afficher.php");
    exit();
}
?> 