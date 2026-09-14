<?php

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nom = trim($_POST['nom'] ?? '');
    $vignette = trim($_POST['vignette'] ?? '');
    $resume = trim($_POST['resume'] ?? '');
    $date_sortie = trim($_POST['date'] ?? '');
    $serie_id = filter_input(INPUT_POST, 'serie_id', FILTER_VALIDATE_INT);

    if (!empty($nom) && !empty($date_sortie) && $serie_id !== false && $serie_id !== null) {

        $sql = "INSERT INTO saison (nom, vignette, date_sortie, resume, serie_id) VALUES (:nom, :vignette, :date_sortie, :resume, :serie_id)";

         $stmt = $pdo->prepare($sql);
    $succes = $stmt->execute([

        ':nom' => $nom,
        ':vignette' => $vignette,
        ':date_sortie' => $date_sortie,
        ':resume' => $resume,
        ':serie_id' => $serie_id,
    ]);

    if($succes){
        header('Location: ../public/liste_saison.php');
        exit;
    }
    }

    http_response_code(400);
    exit('Les champs nom, date de sortie et série sont obligatoires.');
}

http_response_code(405);
exit('Méthode non autorisée.');
?>