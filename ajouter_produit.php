<?php
include('admin.php');

// Connectez-vous à la base de données
$conn = mysqli_connect("localhost", "root", "", "ecommerce");

// Vérifiez la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Sélectio les produits depuis la base de données
$result = mysqli_query($conn, "SELECT nom_produit, prix_produit,quantite, image_produit FROM produits");

// Vérifiez s'il y a des résultats
if (mysqli_num_rows($result) > 0) {
    // Affichez les produits dans un tableau
    echo "<table border='1'>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>quantite</th>
                <th>Image</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['nom_produit'] . "</td>
                <td>" . $row['prix_produit'] . "</td>
                <td>" . $row['quantite'] . "</td>
                <td><img src='" . $row['image_produit'] . "' alt='Image du produit'></td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Aucun produit trouvé.";
}

// Fermez la connexion à la base de données
mysqli_close($conn);
?>
