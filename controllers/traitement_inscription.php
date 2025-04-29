<?php
include('../../config/connexion.php');

// Vérification des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $nom = htmlspecialchars($_POST['lastName']);
    $prenom = htmlspecialchars($_POST['firstName']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validation des données
    $errors = [];
    
    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide";
    }
    
    // Vérification si l'email existe déjà
    $check_email = $conn->prepare("SELECT email FROM client WHERE email = ?");
    $check_email->execute([$email]);
    if ($check_email->rowCount() > 0) {
        $errors[] = "Cette adresse email est déjà utilisée";
    }
    
    // Vérification des mots de passe
    if ($password !== $confirmPassword) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }
    
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
    }
    
    // S'il n'y a pas d'erreurs
    if (empty($errors)) {
        try {
            // Hashage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertion dans la base de données
            $stmt = $conn->prepare("INSERT INTO client (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $email, $hashedPassword]);
            
            // Redirection vers une page de succès
            header('Location: afficher.php');
            exit();
        } catch(PDOException $e) {
            die("Erreur lors de l'inscription : " . $e->getMessage());
        }
    } else {
        // Afficher les erreurs
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
} else {
    // Si la méthode n'est pas POST, rediriger
    header('Location: inscription.php');
    exit();
}
?>