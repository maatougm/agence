<?php
include('../../config/connexion.php');

if (isset($_GET['id'])) {
    $id_reservation = $_GET['id'];
    
    try {
        $deleteQuery = $conn->prepare("DELETE FROM reservation WHERE id_reservation = ?");
        $result = $deleteQuery->execute([$id_reservation]);
        
        if ($result) {
            header("Location: afficher2.php?delete_success=1");
            exit();
        } else {
            header("Location: afficher2.php?delete_error=1");
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error deleting reservation: " . $e->getMessage());
        header("Location: afficher2.php?delete_error=1");
        exit();
    }
} else {
    header("Location: afficher2.php");
    exit();
}
?> 