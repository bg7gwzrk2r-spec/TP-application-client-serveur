<?php
// inc/gabarit.php — Présentation commune (le HTML est GÉNÉRÉ par le serveur).
function entete(string $titre): void { ?>
<!doctype html>
<html lang="fr"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($titre) ?> — Scolarité</title>
<link rel="stylesheet" href="style.css"></head>
<body><header><h1>Scolarité — application 3-tiers</h1>
<nav><a href="index.php">Étudiants</a> · <a href="classement.php">Classement</a></nav>
<p class="info">Page produite par le serveur d'application <strong><?= h(gethostname()) ?></strong>
(<?= h($_SERVER['SERVER_ADDR'] ?? '') ?>) — version <?= VERSION_APPLI ?></p></header><main>
<?php }
function pied(): void { ?>
</main><footer>UCAD · ESP · Département Génie Informatique — TP ACSW</footer></body></html>
<?php }
