<?php
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $produit_id = $_GET['id'];

    // Si le panier existe
    if (isset($_SESSION['panier']) && is_array($_SESSION['panier']) && count($_SESSION['panier']) > 0) {
        // Recherchez l'indice du produit dans le panier
        foreach ($_SESSION['panier'] as $key => $produit) {
            if ($produit['id'] == $produit_id) {
                // Retirez le produit du panier
                unset($_SESSION['panier'][$key]);

                // Réorganisez les indices du tableau après le retrait
                $_SESSION['panier'] = array_values($_SESSION['panier']);

                // Redirigez l'utilisateur vers la page du panier avec un message de succès
                header("Location: panier.php?message=Produit retiré du panier avec succès");
                exit();
            }
        }
    }

    // Si le produit n'a pas été trouvé dans le panier, redirigez l'utilisateur vers le panier
    header("Location: panier.php");
    exit();
} else {
    echo "ID de produit non valide.";
}
?>
