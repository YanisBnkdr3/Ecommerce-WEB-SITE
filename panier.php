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
    <title>Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylehome.css"> <!-- Assurez-vous d'inclure votre feuille de style -->
</head>
<body>

<div class="container mt-5">
<ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="home.php">Accueil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">se deconnecter</a>
        </li>
    </ul>
</nav>
    <h1>Votre Panier</h1>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Total</th>
                <th scope="col">Retirer du panier</th>
            </tr>
        </thead>
        <tbody>
            <?php
          // ...

foreach ($_SESSION['panier'] as $produit) {
    echo "<tr>";
    echo "<td>" . $produit['nom_produit'] . "</td>";
    echo "<td>" . $produit['prix_produit'] . "</td>";
    echo "<td>" . $produit['quantite'] . "</td>";

    // Vérifiez si les valeurs sont numériques avant de les utiliser
    if (is_numeric($produit['prix_produit']) && is_numeric($produit['quantite'])) {
        echo "<td>" . ($produit['prix_produit'] * $produit['quantite']) . "</td>";
    } else {
        echo "<td>Erreur de calcul</td>";
    }

    echo "<td><a href='retirer_panier.php?id=" . $produit['id'] . "' class='btn btn-danger'>Retirer</a></td>";
    echo "</tr>";
}



            ?>
        </tbody>
    </table>
</div>

</body>
</html>
