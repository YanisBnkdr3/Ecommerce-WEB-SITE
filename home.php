<?php

session_start();
if (!isset($_SESSION['nom_utilisateur'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylehome.css"> 
</head>
<body>

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
    </ul>
</nav>
    <h1>Les Produits disponibles</h1>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Image</th>
                <th scope="col">Ajouter au panier</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "ecommerce");
            $result = mysqli_query($conn, "SELECT * FROM produits");

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nom_produit'] . "</td>";
                echo "<td>" . $row['prix_produit'] . "</td>";
                echo "<td>" . $row['quantite'] . "</td>";
                echo "<td><img src='" . $row['image_produit'] . "' alt='Image du produit' width='50'></td>";
                echo "<td><a href='ajouter_panier.php?id=" . $row['id'] . "' class='btn btn-primary'>Ajouter au panier</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
