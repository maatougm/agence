<?php
// Démarrer une session
session_start();

include('../config/connexion.php');

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        try {
            $stmt = $conn->prepare("SELECT * FROM admins WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                if (password_verify($password, $admin['password'])) {
                    // Connexion réussie
                    $_SESSION['admin_id'] = $admin['id_admin'];
                    $_SESSION['admin_role'] = $admin['role'];
                    $_SESSION['admin_email'] = $admin['email'];
                    $_SESSION['admin_nom'] = $admin['nom'] ?? 'Admin';
                    
                    // Rediriger vers le tableau de bord
                    header('Location: admindashboard.php');
                    exit;
                } else {
                    $error = "Mot de passe incorrect.";
                }
            } else {
                $error = "Aucun compte trouvé avec cet email.";
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de la connexion: " . $e->getMessage();
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}

// Inclure la vue
include('../views/login.php');