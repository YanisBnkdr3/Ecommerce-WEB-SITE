<?php
// login_admin.php


session_start();

// Vérifier si l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // Rediriger vers la page de connexion admin si l'utilisateur n'est pas authentifié
    header("Location: login_admin.php");
    exit();
}
?>