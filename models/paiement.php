<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset=utf-8>
	<title>Explore monde</title>
	<meta name="description" content="agence de voyage">
	<meta name="keywords" content="treveling,voyage,agence de voyage">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('images/hero-bg.jpg') center/cover;
            color: white;
            padding: 8rem 0;
            text-align: center;
        }

        .destination-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .destination-card:hover {
            transform: translateY(-10px);
        }

        .newsletter-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }
    </style>
    
</head>
<body>
    <header>
<?php include  '../views/partials/header.php'; ?>
                    
            
     </header>
    <div class="container">
        <h1>Paiement Sécurisé</h1>
    

        <form class="payment-form" action="#">
            <div class="form-group">
                <label for="card-number">Numéro de carte</label>
                <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required pattern="[0-9\s]{13,19}">
            </div>

            <div class="form-group">
                <label for="expiry-date">Date d'expiration</label>
                <input type="month" id="expiry-date" name="expiry-date" required>
            </div>

           à

            <div class="form-group">
                <label for="card-name">Nom sur la carte</label>
                <input type="text" id="card-name" name="card-name" placeholder="JEAN DUPONT" required>
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label for="country">Pays</label>
                <select id="country" name="country" required>
                    <option value="">Sélectionnez un pays</option>
                    <option value="FR">France</option>
                    <option value="BE">Belgique</option>
                    <option value="CH">Suisse</option>
                </select>
            </div>

            <button type="submit" class="btn-payer">Payer maintenant</button>
        </form>
    </div>
    <?php include  '../views/partials/footer.php'; ?>
</body>
</html>