<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "ecommerce");

if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Récupération de les informations de l'utilisateur depuis la base de données
    $result = mysqli_query($conn, "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$nom_utilisateur'");

    if ($result && $row = mysqli_fetch_assoc($result)) {
        // Vérification de mot de passe
        if (password_verify($mot_de_passe, $row['mot_de_passe'])) {
            // Mot de passe correct, enregistrez l'utilisateur dans la session et redirigez-le
            $_SESSION['nom_utilisateur'] = $nom_utilisateur;
            header("Location: home.php"); // Redirige vers la page principale après connexion
            exit();
        } else {
            echo "Mot de passe incorrect.";
           
        }
    } else {
        echo "Nom d'utilisateur non trouvé.";
    }
}
?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="style2.css">
    </head>
<body>
    <h1>Entrez a votre compte!!</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="nom">  Nom d'utilisateur:</div> <input type="text" name="nom_utilisateur" required><br>
    <div class="mdp">  Mot de passe:</div> <input type="password" name="mot_de_passe" required><br>
        <input type="submit" value="Se connecter">
    </form>
    <p>Pas encore inscrit ? <a href="register.php">Inscrivez-vous ici</a>.</p>
</body>
</html>
