<?php
include('../../config/connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $id_destination = $_POST['id_destination'];
        $nom = $_POST['nom'];
        $pays = $_POST['pays'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];

        // Prepare and execute the update query
        $query = $conn->prepare("UPDATE destinations SET nom = ?, pays = ?, description = ?, prix = ? WHERE id_destination = ?");
        $result = $query->execute([$nom, $pays, $description, $prix, $id_destination]);

        if ($result) {
            // Redirect back to the destinations list with success message
            header("Location: affichdes.php?success=1");
            exit();
        } else {
            // Redirect back with error message
            header("Location: affichdes.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        // Log the error and redirect with error message
        error_log("Error updating destination: " . $e->getMessage());
        header("Location: affichdes.php?error=1");
        exit();
    }
} else {
    // If not a POST request, redirect to the destinations list
    header("Location: affichdes.php");
    exit();
}
?> 