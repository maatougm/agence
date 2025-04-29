<?php
// delete_form.php
include '../../config/connexion.php';

if (isset($_GET['id'])) {
    $id_client = $_GET['id'];
    
    // First, get the client details to show in the confirmation
    $query = $conn->prepare("SELECT * FROM client WHERE id_client = ?");
    $query->execute([$id_client]);
    $client = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($client) {
        // If form is submitted, delete the client
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $deleteQuery = $conn->prepare("DELETE FROM client WHERE id_client = ?");
                $result = $deleteQuery->execute([$id_client]);
                
                if ($result) {
                    header("Location: afficher.php?delete_success=1");
                    exit();
                } else {
                    header("Location: afficher.php?delete_error=1");
                    exit();
                }
            } catch (PDOException $e) {
                error_log("Error deleting client: " . $e->getMessage());
                header("Location: afficher.php?delete_error=1");
                exit();
            }
        }
    } else {
        header("Location: afficher.php?error=client_not_found");
        exit();
    }
} else {
    header("Location: afficher.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h3>Confirmer la suppression</h3>
            </div>
            <div class="card-body">
                <p>Êtes-vous sûr de vouloir supprimer le client suivant ?</p>
                <p><strong>Nom:</strong> <?= htmlspecialchars($client['nom']) ?></p>
                <p><strong>Prénom:</strong> <?= htmlspecialchars($client['prenom']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($client['email']) ?></p>
                
                <form method="POST" class="mt-3">
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                    <a href="afficher.php" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>