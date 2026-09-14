<?php

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nom = trim($_POST['nom'] ?? '');
    $vignette = trim($_POST['vignette'] ?? '');
    $resume = trim($_POST['resume'] ?? '');
    $date_sortie = trim($_POST['date'] ?? '');

    if(!empty($nom) && !empty($date_sortie)){

        $sql = "INSERT INTO serie (nom, vignette, date_sortie, resume) VALUES (:nom, :vignette, :date_sortie, :resume)";

         $stmt = $pdo->prepare($sql);
    $succes = $stmt->execute([

        ':vignette' => $vignette,
        ':nom' => $nom,
        ':resume' => $resume,
        ':date_sortie' => $date_sortie,
    ]);

    if($succes){
        header('Location: ../public/liste_series.php');
        exit;
    }
    }
}
?>