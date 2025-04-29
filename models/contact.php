<!DOCTYPE html>
<html lang=fr>
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
<?php include  '../views/partials/header.php'; ?>
	  <h1>Contactez-nous</h1>
   </header>
	  <fieldset>
		<section>
		 <h2>Nous sommes là pour vous aider</h2>
        <form action="submit_contact.php" method="post">
		    <div>
               <label for="nom">Nom :</label>
               <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
		    </div>	
			     <label for="prenom">Prènom:</label>
                 <input type="text" id="prenom" name="prenom" placeholder="Votre prenom" required>
		  	 <div>
	           <label for="email"> Adresse e-mail :</label>
		       <input type="email" size="40"maxlength="50" name="email" id="email"placeholder="Votre e-mail" required />
		     </div>
		     <div>
		        <label for="pass">Mot de passe :</label>
		        <input type="password" size="30"maxlength="50" name="pass" id="pass" placeholder="Votre mot de passe" required />
		        <br><a href="#">Mot de passe oublié ?</a></br>
		     </div>
		     <div>
		        <button type="submit">Se connecter</button>
		        <button type="reset">Annuler</button>
		    </div>
			<div>
			     <label for="message">Message :</label></br>
                 <textarea id="message" name="message" rows="4" placeholder="Votre message"></textarea>
                 <button type="submit">Envoyer</button>
			</div>
		</form>
	  </fieldset>
	  <section>
	  <div class="contact-info">
            <h3>Nos coordonnées</h3>
            <p><strong>Adresse :</strong> 123 Rue des Voyages, Tunis, Tunisie</p>
            <p><strong>Téléphone :</strong> +216 123 456 789</p>
            <p><strong>Email :</strong> contact@Exploremonde.com</p>
        </div>
		</section>
      <footer>
        <p>&copy; 2024 Explore monde </p>
      </footer>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
      <?php include  '../views/partials/footer.php'; ?>
  </body>
</html>