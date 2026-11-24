<?php
require_once __DIR__ . '/inc/metier.php';
require_once __DIR__ . '/inc/gabarit.php';
$debut = microtime(true);
$c = classement(10);
$duree = (microtime(true) - $debut) * 1000;
entete('Classement'); ?>
<h2>Les 10 meilleures moyennes</h2>
<table><tr><th>Rang</th><th>Matricule</th><th>Moyenne</th></tr>
<?php foreach ($c['top'] as $i => $l): ?>
  <tr><td><?= $i + 1 ?></td><td><?= h($l['matricule']) ?></td><td><?= number_format($l['moyenne'], 2) ?></td></tr>
<?php endforeach; ?>
</table>
<p class="bilan">Admis : <?= (int) $c['bilan']['admis'] ?> / <?= (int) $c['bilan']['total'] ?>
— calculé par le SGBD en <?= number_format($duree, 0) ?> ms</p>
<?php pied();
