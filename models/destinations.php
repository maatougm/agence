<!DOCTYPE html>
<html lang=fr>
<head>
    <meta charset=utf-8>
	<title>Explore monde</title>
	<meta name="description" content="agence de voyage">
	<meta name="keywords" content="treveling,voyage,agence de voyage">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header>
<?php include  '../views/partials/header.php'; ?>
	  </header>
<section id="destinations">
    <h2>Destinations populaires</h2>
	<h3>Explorez l'inoubliable : là où l'histoire rencontre la beauté intemporelle.</h3>
    <table border="1" class="destinations_table">
	
        <thead>
            <tr>
                <th>Image</th>
                <th>Destination</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Destination 1 -->
            <tr>
                <td><img src="../assets/images/maldives.jpg" alt="Plage aux Maldives" width="180"></td>
                <td>Les Maldives</td>
                <td>"Un paradis tropical avec des plages de sable blanc, des eaux cristallines et des bungalows sur l'eau."</td>
                <td><button onclick="window.location.href='https://www.lesmaldives.fr/'">En savoir plus</button></td>
            </tr>
            <!-- Destination 2 -->
            <tr>
                <td><img src="../assets/images/rome.jpg" alt="Vue du Colisée à Rome" width="180"></td>
                <td>Rome, Italie</td>
                <td>"Plongez dans l'histoire ancienne avec des monuments iconique et une cuisine incroyable."</td>
                <td><button onclick="window.location.href='https://generationvoyage.fr/visiter-rome-faire-voir/'">En savoir plus</button></td>
            </tr>
            <!-- Destination 3 -->
            <tr>
                <td><img src="../assets/images/opera.jpg" alt="Opéra de Sydney" width="180"></td>
                <td>Sydney, Australie</td>
                <td>"Découvrez l'Opéra de Sydney, les plages iconiques et une culture vibrante."</td>
                <td><button onclick="window.location.href='https://generationvoyage.fr/visiter-sydney-faire-voir/'">En savoir plus</button></td>
            </tr>
        </tbody>
    </table>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<?php include  '../views/partials/footer.php'; ?>
</body>
</html>
