<?php
require_once __DIR__ . '/inc/metier.php';
require_once __DIR__ . '/inc/gabarit.php';
$etu = releve($_GET['matricule'] ?? '');
entete('Relevé');
if (!$etu): ?>
  <p class="erreur">Matricule inconnu.</p>
<?php else: ?>
<h2>Relevé de <?= h($etu['prenom'] . ' ' . $etu['nom']) ?> (<?= h($etu['matricule']) ?>)</h2>
<table><tr><th>EC</th><th>Intitulé</th><th>Crédits</th><th>Note</th></tr>
<?php foreach ($etu['notes'] as $n): ?>
  <tr><td><?= h($n['code']) ?></td><td><?= h($n['intitule']) ?></td>
      <td><?= h($n['credits']) ?></td><td><?= h($n['valeur']) ?></td></tr>
<?php endforeach; ?>
</table>
<p class="bilan">Moyenne pondérée : <strong><?= number_format($etu['moyenne'], 2) ?> / 20</strong>
— <?= h($etu['decision']) ?></p>
<?php endif; pied();
