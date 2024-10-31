<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Rediriger vers la page de connexion admin si l'utilisateur n'est pas authentifié
    header("Location: login_admin.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "ecommerce");

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Récupération les données du formulaire
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $prix = isset($_POST['prix']) ? $_POST['prix'] : '';
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : '';

    // on  Gére le téléchargement de l'image
    $dossier_images = "./photosprojet/"; // Dossier où les images sont stockées
    $nom_fichier = basename($_FILES["image"]["name"]);
    $chemin_image = $dossier_images . $nom_fichier;

    // Vérification si une image a été téléchargée
    if (!empty($_FILES["image"]["tmp_name"])) {
    
        move_uploaded_file($_FILES["image"]["tmp_name"], $chemin_image);
    }

    // Inséretion de nouveau produit dans la base de données
    $query = "INSERT INTO produits (nom_produit, prix_produit,quantite, image_produit) VALUES ('$nom', '$prix','$quantite', '$chemin_image')";
    
    if (mysqli_query($conn, $query)) {
        // on Redirige l'utilisateur vers la page d'accueil avec un message de succès
        header("Location: home.php?message=Produit ajouté avec succès");
        exit();
    } else {
        echo "Erreur d'insertion dans la base de données : " . mysqli_error($conn);
    }
}

// Fermetteure de la connexion à la base de données
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="styleadmin.css"> 
</head>
<body class="back">

<div class="container mt-5"> 
<ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="home.php">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="panier.php">Panier</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Se déconnecter</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="gestionusers.php">gestion users</a>
        </li>
    </ul>
</nav>

    <h2 class="mb-4">Ajouter un produit</h2>

    <form action="ajouter_produit.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix:</label>
            <input type="text" class="form-control" id="prix" name="prix" required>
        </div>
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité:</label>
            <input type="text" class="form-control" id="quantite" name="quantite" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Ajouter le produit</button>
        
    </form>

</div>

</body>
</html>

