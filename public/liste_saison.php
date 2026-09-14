<?php
require_once '../inc/db.php';

// Récupération des saisons de la série sélectionnée
$serieId = filter_input(INPUT_GET, 'serie_id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare("SELECT * FROM saison WHERE serie_id = :serie_id");
$stmt->execute([':serie_id' => $serieId ?: 0]);
$saisons = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Series Companion - Liste des saisons</title>
    <link href="../public/assets/output.css" rel="stylesheet" type="text/css" />
</head>
<body class="px-5">
    <header class="flex flex-row items-center py-2 justify-between">
        <p class="font-bold text-sky-500 text-3xl">My saisons Companion</p>
        <a class="cursor-pointer bg-sky-500 p-2 rounded-xl" href="form_ajout_saison.php?serie_id=<?= (int) $serieId ?>">Ajouter une saison</a>
    </header>
   
    <?php if (empty($saisons)): ?>
    <div class="alert alert-warning">
        <span>Aucune série trouvée</span>
    </div>
<?php else: ?>

    <!-- COMPTEUR DE saisons -->
    <div class="mb-4 font-bold text-lg">
        Séries disponibles : <?= count($saisons) ?>
    </div>

    <!-- GRILLE -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach ($saisons as $saison): ?>
            
            <!-- Carte pour une série -->
            <div class="card bg-base-100 shadow p-4 flex flex-col gap-2">
                
                <!-- VIGNETTE DE LA saison -->
                <?php if (!empty($saison['vignette'])): ?>
                    <div class="overflow-hidden rounded-lg">
                        <img src="<?= htmlspecialchars($saison['vignette']) ?>" alt="<?= htmlspecialchars($saison['nom']) ?>" class="w-full h-48 object-cover">
                    </div>
                <?php endif; ?>

                <!-- NOM DE LA saison -->
                <div>
                    <h2 class="text-xl font-bold text-sky-500"><?= htmlspecialchars($saison['nom']) ?></h2>
                </div>

                <!-- RESUME DE LA saison -->
                <div>
                    <p class="text-sm opacity-80 line-clamp-3"><?= htmlspecialchars($saison['resume']) ?></p>
                </div>

                <!-- DATE DE SORTIE DE LA saison -->
                <div class="mt-auto pt-2 text-xs text-base-content/60">
                    Sortie : <?= htmlspecialchars($saison['date_sortie']) ?>
                </div>

                <a href="liste_episode.php?saison_id=<?= (int) $saison['id'] ?>" class="bg-base-400 rounded-xl">Voir les épisodes</a>

            </div>

        <?php endforeach; ?>
    </div>

<?php endif; ?>
</body>
</html>