<?php
require_once '../inc/db.php';

// Récupération de toutes les séries
$stmt = $pdo->query("SELECT * FROM serie");
$series = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Series Companion - Liste des séries</title>
    <!-- Lien vers ton CSS compilé par Tailwind v4 / daisyUI -->
    <link href="../public/assets/output.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-base-300 text-base-content min-h-screen flex flex-col">

    <header class="bg-red">

    </header>
    <div>
        <img>
    <div>
    <div>
        <h2><?= htmlspecialchars($series[] ?></h2>
    </div>
</body>
</html>