<?php
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produit_id = $_GET['id'];

    // connection à la base de données
    $conn = mysqli_connect("localhost", "root", "", "ecommerce");

    // Vérification de la connexion
    if (!$conn) {
        die("La connexion à la base de données a échoué : " . mysqli_connect_error());
    }

    // Récupération des informations du produit depuis la base de données
    $result = mysqli_query($conn, "SELECT * FROM produits WHERE id = $produit_id");

    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Ajoutez le produit au panier
        $produit = array(
            'id' => $row['id'],
            'nom_produit' => $row['nom_produit'],
            'prix_produit' => $row['prix_produit'],
            'quantite' => 1 // Initialisation de  la quantité à 1
        );

        // Si le panier n'existe pas, on le crre
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = array();
        }

        // Vérification si le produit est déjà dans le panier
        $produit_existe = false;
        foreach ($_SESSION['panier'] as &$item) {
            if ($item['id'] == $produit['id']) {
                $item['quantite']++;
                $produit_existe = true;
                break;
            }
        }

        // Si le produit n'est pas déjà dans le panier, on l ajoute
        if (!$produit_existe) {
            $_SESSION['panier'][] = $produit;
        }

        // on redige l'utilisateur vers la page d'accueil avec un message de succès
        header("Location: home.php?message=Produit ajouté au panier avec succès");
        exit();
    } else {
        echo "Produit non trouvé.";
    }

    // Fermeteur de  la connexion à la base de données
    mysqli_close($conn);
} else {
    echo "ID de produit non valide.";
}
?>
