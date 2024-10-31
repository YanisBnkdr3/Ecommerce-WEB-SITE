<?php

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "ecommerce");

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Récupération des utilisateurs depuis la base de données
$result = mysqli_query($conn, "SELECT nom_utilisateur, email FROM utilisateurs");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Gestion des Utilisateurs</h2>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">Nom d'utilisateur</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['nom_utilisateur'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php

mysqli_close($conn);
?>
