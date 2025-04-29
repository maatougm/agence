<?php
include('../../config/connexion.php');

if (isset($_GET['id'])) {
    $id_destination = $_GET['id'];
    
    try {
        $deleteQuery = $conn->prepare("DELETE FROM destinations WHERE id_destination = ?");
        $result = $deleteQuery->execute([$id_destination]);
        
        if ($result) {
            header("Location: affichdes.php?delete_success=1");
            exit();
        } else {
            header("Location: affichdes.php?delete_error=1");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error deleting destination: " . $e->getMessage());
        header("Location: affichdes.php?delete_error=1");
        exit();
    }
} else {
    header("Location: affichdes.php");
    exit();
}
?> 