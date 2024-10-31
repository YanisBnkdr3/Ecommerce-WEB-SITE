<?php
// login_admin.php

// Démarrer la session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les informations de connexion
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifie les informations de connexion (vous devrez remplacer ceci par votre propre logique d'authentification)
    if ($username == 'admin' && $password == 'admin') {
        // Définir la variable de session 'admin' à true
        $_SESSION['admin'] = true; 
        // Redirige vers la page d'ajout de produit
        header("Location: ajouter_produit.php");
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5"> 

    <h2 class="mb-4">Connexion Administrateur</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

</div>

</body>
</html>
