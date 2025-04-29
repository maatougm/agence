<?php
include('connexion.php');

// Vérification des données du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage des données
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $numtel = htmlspecialchars(trim($_POST['numtel']));
    $destination = htmlspecialchars(trim($_POST['destination']));
    $datedepart = $_POST['datedepart'];
    $datcretour = $_POST['datcretour'];
    $nbroyageur = intval($_POST['nbroyageur']);
    
    // Validation des données
    $errors = [];
    
    // Validation des champs obligatoires
    if (empty($nom)) $errors[] = "Le nom est obligatoire";
    if (empty($prenom)) $errors[] = "Le prénom est obligatoire";
    if (empty($email)) $errors[] = "L'email est obligatoire";
    if (empty($numtel)) $errors[] = "Le numéro de téléphone est obligatoire";
    if (empty($destination)) $errors[] = "La destination est obligatoire";
    if (empty($datedepart)) $errors[] = "La date de départ est obligatoire";
    if (empty($datcretour)) $errors[] = "La date de retour est obligatoire";
    if ($nbroyageur < 1) $errors[] = "Le nombre de voyageurs doit être au moins 1";
    
    // Vérification de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide";
    }
    
    // Vérification des dates
    if (!empty($datedepart) && !empty($datcretour)) {
        $depart = new DateTime($datedepart);
        $retour = new DateTime($datcretour);
        
        if ($retour <= $depart) {
            $errors[] = "La date de retour doit être après la date de départ";
        }
        
        // Optionnel: vérifier que la date de départ est dans le futur
        $today = new DateTime();
        if ($depart < $today) {
            $errors[] = "La date de départ doit être dans le futur";
        }
    }
    
    // S'il n'y a pas d'erreurs
    if (empty($errors)) {
        try {
            $conn->beginTransaction();
            
            // 1. Vérifier si le client existe déjà
            $client_id = null;
            $check_client = $conn->prepare("SELECT id FROM client WHERE email = ?");
            $check_client->execute([$email]);
            
            if ($check_client->rowCount() > 0) {
                // Client existe, on récupère son ID
                $client = $check_client->fetch(PDO::FETCH_ASSOC);
                $client_id = $client['id'];
                
                // Optionnel: mettre à jour les infos du client
                $update_client = $conn->prepare("UPDATE client SET nom = ?, prenom = ?, numtel = ? WHERE id = ?");
                $update_client->execute([$nom, $prenom, $numtel, $client_id]);
            } else {
                // Client n'existe pas, on le crée
                $insert_client = $conn->prepare("INSERT INTO client (nom, prenom, email, numtel) VALUES (?, ?, ?, ?)");
                $insert_client->execute([$nom, $prenom, $email, $numtel]);
                $client_id = $conn->lastInsertId();
            }
            
            // 2. Création de la réservation
            $insert_reservation = $conn->prepare("INSERT INTO reservation 
                (client_id, destination, datedepart, datcretour, nbroyageur) 
                VALUES (?, ?, ?, ?, ?)");
            $insert_reservation->execute([
                $client_id, 
                $destination, 
                $datedepart, 
                $datcretour, 
                $nbroyageur
            ]);
            
            $conn->commit();
            
            header('Location: afficher2.php');
            exit();
            
        } catch(PDOException $e) {
            $conn->rollBack();
            die("Erreur lors de la réservation : " . $e->getMessage());
        }
    } else {
        // Stocker les erreurs en session pour les afficher sur le formulaire
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: ../models/réservation.php');
        exit();
    }
} else {
    // Si la méthode n'est pas POST, rediriger
    header('Location: ../models/réservation.php');
    exit();
}
?>