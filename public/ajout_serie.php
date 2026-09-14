<?php 
require_once "../inc/db.php";
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
<form method=POST" action="liste_serie.php" class="flex flex-col align-center w-150 py-3 mx-auto">
    <h2>Ajouter une série</h2>
    <label>Vignette de la série (lien)</label>
    <input type="text" placeholder="Type here" class="input border-sky-500" name="vignette" />
    <label>Nom de la série</label>
    <input type="text" placeholder="Type here" class="input border-sky-500" name="nom" />
    <label>Resumé de la série</label>
    <input type="text" placeholder="Type here" class="input border-sky-500" name="resume" />
    <label>Date de sortie</label>
    <input type="text" placeholder="Type here" class="input border-sky-500" name="date" />    
</form>