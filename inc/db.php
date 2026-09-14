<?php
// 1. Définition des paramètres de connexion
$host     = 'localhost';
$dbname   = 'my_series_companion'; // Remplace par le nom exact de ta BDD
$user     = 'root';               // Utilisateur MySQL par défaut sous Wamp/Xampp
$password = '';                   // Mot de passe ('root' sous Mac/MAMP, vide sous Windows)

try {
    // 2. Création de l'instance PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password,
        [
            // Active la levée d'exceptions en cas d'erreur SQL (essentiel pour le débogage)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            
            // Définit le mode de récupération par défaut sous forme de tableau associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    // 3. Gestion des erreurs de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}