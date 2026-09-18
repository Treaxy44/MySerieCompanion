<?php

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nom = trim($_POST['nom'] ?? '');
    $vignette = trim($_POST['vignette'] ?? '');
    $resume = trim($_POST['resume'] ?? '');
    $date_sortie = trim($_POST['date'] ?? '');
    $duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
    $serie_id = filter_input(INPUT_POST, 'serie_id', FILTER_VALIDATE_INT);
    $saison_id = filter_input(INPUT_POST, 'saison_id', FILTER_VALIDATE_INT);

    if (!empty($nom) && !empty($date_sortie) && $duree !== false && $duree !== null && $serie_id !== false && $serie_id !== null && $saison_id !== false && $saison_id !== null) {
        $saisonStmt = $pdo->prepare('SELECT id FROM saison WHERE id = :saison_id AND serie_id = :serie_id');
        $saisonStmt->execute([
            ':saison_id' => $saison_id,
            ':serie_id' => $serie_id,
        ]);

        if (!$saisonStmt->fetch()) {
            http_response_code(400);
            exit('La saison sélectionnée ne correspond pas à la série.');
        }

        $sql = "INSERT INTO episode (nom, vignette, date_sortie, resume, duree, saison_id) VALUES (:nom, :vignette, :date_sortie, :resume, :duree, :saison_id)";

         $stmt = $pdo->prepare($sql);
    $succes = $stmt->execute([

        ':nom' => $nom,
        ':vignette' => $vignette,
        ':date_sortie' => $date_sortie,
        ':resume' => $resume,
        ':duree' => $duree,
        ':saison_id' => $saison_id,
    ]);

    if($succes){
        header('Location: ../public/liste_episode.php?saison_id=' . $saison_id);
        exit;
    }
    }

    http_response_code(400);
    exit('Les champs nom, date, durée, série et saison sont obligatoires.');
}

http_response_code(405);
exit('Méthode non autorisée.');
?>