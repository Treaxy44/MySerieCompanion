<?php
require_once '../inc/db.php';

$saisonId = filter_input(INPUT_GET, 'saison_id', FILTER_VALIDATE_INT);
$saisonId = $saisonId ?: 0;

$saisonStmt = $pdo->prepare('SELECT id, nom, serie_id FROM saison WHERE id = :saison_id');
$saisonStmt->execute([':saison_id' => $saisonId]);
$saison = $saisonStmt->fetch();

$episodeStmt = $pdo->prepare('SELECT * FROM episode WHERE saison_id = :saison_id ORDER BY date_sortie, id');
$episodeStmt->execute([':saison_id' => $saisonId]);
$episodes = $episodeStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr" data-theme="dark">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Series Companion - Liste des épisodes</title>
	<link href="../public/assets/output.css" rel="stylesheet" type="text/css" />
</head>
<body class="px-5">
	<header class="flex flex-row items-center py-2 justify-between">
		<div>
			<p class="font-bold text-sky-500 text-3xl">My épisodes Companion</p>
			<?php if ($saison): ?>
				<p class="text-sm opacity-80">Saison : <?= htmlspecialchars($saison['nom']) ?></p>
			<?php endif; ?>
		</div>
		<?php if ($saison): ?>
			<a class="cursor-pointer bg-sky-500 p-2 rounded-xl" href="form_ajout_episode.php">Ajouter un épisode</a>
		<?php endif; ?>
	</header>

	<?php if (!$saison): ?>
		<div class="alert alert-warning">
			<span>Saison introuvable</span>
		</div>
	<?php elseif (empty($episodes)): ?>
		<div class="alert alert-warning">
			<span>Aucun épisode trouvé</span>
		</div>
	<?php else: ?>
		<div class="mb-4 font-bold text-lg">
			Épisodes disponibles : <?= count($episodes) ?>
		</div>

		<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
			<?php foreach ($episodes as $episode): ?>
				<div class="card bg-base-100 shadow p-4 flex flex-col gap-2">
					<?php if (!empty($episode['vignette'])): ?>
						<div class="overflow-hidden rounded-lg">
							<img src="<?= htmlspecialchars($episode['vignette']) ?>" alt="<?= htmlspecialchars($episode['nom']) ?>" class="w-full h-48 object-cover">
						</div>
					<?php endif; ?>

					<div>
						<h2 class="text-xl font-bold text-primary"><?= htmlspecialchars($episode['nom']) ?></h2>
					</div>

					<div>
						<p class="text-sm opacity-80 line-clamp-3"><?= htmlspecialchars($episode['resume'] ?? '') ?></p>
					</div>

					<div class="mt-auto pt-2 text-xs text-base-content/60">
						Sortie : <?= htmlspecialchars($episode['date_sortie']) ?>
						<?php if ($episode['duree'] !== null): ?>
							<span> | Durée : <?= (int) $episode['duree'] ?> min</span>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</body>
</html>
