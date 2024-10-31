<?php
$conn = mysqli_connect("localhost", "root", "", "ecommerce");

if (!$conn) {
    die("Connexion échouée : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

    // Vérification que le mot de passe et la confirmation sont identiques
    if ($mot_de_passe == $confirmation_mot_de_passe) {
        // Hachage du mot de passe
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Inséretion les données dans la base de données
        $query = "INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe) VALUES ('$nom_utilisateur', '$email', '$mot_de_passe_hache')";

        if (mysqli_query($conn, $query)) {
            echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        } else {
            echo "Erreur d'inscription : " . mysqli_error($conn);
        }
    } else {
        echo "Le mot de passe et la confirmation du mot de passe ne correspondent pas.";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body class="inscription-body"> 
    <h1>inscrit toi maintenant!!</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
       <div class="nom"> Nom d'utilisateur:</div> <input type="text" name="nom_utilisateur" required><br>
       <div class="email"> E-mail:</div> <input type="email" name="email" required><br>
       <div class="mdp">Mot de passe:</div> <input type="password" name="mot_de_passe" required><br>
       <div class="confirmermdp"> Confirmation du mot de passe:</div> <input type="password" name="confirmation_mot_de_passe" required><br>
        <input type="submit" value="S'inscrire">
    </form>
    <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>.</p>
</body>
</html>
