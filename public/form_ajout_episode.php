<?php 
require_once "../inc/db.php";

$stmt = $pdo->query("SELECT id, nom FROM saison ORDER BY nom");
$saisons = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../public/assets/output.css" rel="stylesheet" type="text/css" />
</head>
<body>
    
</body>
</html>
<form method="POST" action="../inc/ajout_épisode.php" class="flex flex-col align-center justify-center py-3 mx-auto max-w-md gap-2">
    <h2 class="text-xl font-bold">Ajouter un épisode</h2>
    
    <label>Vignette de la épisode (lien)</label>
    <input type="text" placeholder="https://..." class="input border-sky-500" name="vignette" />
    
    <label>Nom de la épisode</label>
    <input type="text" placeholder="Titre de la épisode" class="input border-sky-500" name="nom" required />
    
    <label>Résumé de la épisode</label>
    <textarea placeholder="Résumé..." class="textarea border-sky-500" name="resume"></textarea>

    <label>Date de sortie</label>
    <input type="date" class="input border-sky-500" name="date" required />

    <label>Duree de sortie</label>
    <input type="number" class="input border-sky-500" name="duree" required />
    
    <select name="épisode_id" class="select border-sky-500" required>
        <option value="" disabled selected>-- Choisir une série --</option>
        <?php foreach ($saisons as $saison): ?>
            <option value="<?= (int) $saison['id'] ?>">
                <?= htmlspecialchars($saison['nom']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit" class="btn bg-sky-500 text-white mt-2">Ajouter</button>    
</form>