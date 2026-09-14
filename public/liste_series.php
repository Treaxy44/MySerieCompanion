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
<body class="px-5">
    <header class="flex flex-row items-center py-2 justify-between">
        <p class="font-bold text-sky-500 text-3xl">My Series Companion</p>
        <a class="cursor-pointer bg-sky-500 p-2 rounded-xl" href="form_ajout.php">Ajouter une série</a>
    </header>
   
    <?php if (empty($series)): ?>
    <div class="alert alert-warning">
        <span>Aucune série trouvée</span>
    </div>
<?php else: ?>

    <!-- COMPTEUR DE SERIES -->
    <div class="mb-4 font-bold text-lg">
        Séries disponibles : <?= count($series) ?>
    </div>

    <!-- GRILLE -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach ($series as $serie): ?>
            
            <!-- Carte pour une série -->
            <div class="card bg-base-100 shadow p-4 flex flex-col gap-2">
                
                <!-- VIGNETTE DE LA SERIE -->
                <?php if (!empty($serie['vignette'])): ?>
                    <div class="overflow-hidden rounded-lg">
                        <img src="<?= htmlspecialchars($serie['vignette']) ?>" alt="<?= htmlspecialchars($serie['nom']) ?>" class="w-full h-48 object-cover">
                    </div>
                <?php endif; ?>

                <!-- NOM DE LA SERIE -->
                <div>
                    <h2 class="text-xl font-bold text-primary"><?= htmlspecialchars($serie['nom']) ?></h2>
                </div>

                <!-- RESUME DE LA SERIE -->
                <div>
                    <p class="text-sm opacity-80 line-clamp-3"><?= htmlspecialchars($serie['resume']) ?></p>
                </div>

                <!-- DATE DE SORTIE DE LA SERIE -->
                <div class="mt-auto pt-2 text-xs text-base-content/60">
                    Sortie : <?= htmlspecialchars($serie['date_sortie']) ?>
                </div>

                <a class="bg-base-400 rounded-xl">+ En savoir plus</a>

            </div>

        <?php endforeach; ?>
    </div>

<?php endif; ?>
</body>
</html>