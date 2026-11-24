<?php
require_once __DIR__ . '/inc/metier.php';
require_once __DIR__ . '/inc/gabarit.php';
$filiere = $_GET['filiere'] ?? '';
try { $liste = etudiants($filiere ?: null); }
catch (PDOException $e) { http_response_code(503); $erreur = $e->getMessage(); }
entete('Étudiants'); ?>
<h2>Liste des étudiants</h2>
<form method="get">
  <label>Filière
    <select name="filiere">
      <option value="">Toutes</option>
      <option value="II" <?= $filiere === 'II' ? 'selected' : '' ?>>Informatique</option>
      <option value="RT" <?= $filiere === 'RT' ? 'selected' : '' ?>>Réseaux et Télécommunications</option>
    </select></label>
  <button>Filtrer</button>
</form>
<?php if (isset($erreur)): ?>
  <p class="erreur">Base de données indisponible : <?= h($erreur) ?></p>
<?php else: ?>
<table><tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>Filière</th></tr>
<?php foreach ($liste as $e): ?>
  <tr><td><a href="releve.php?matricule=<?= h($e['matricule']) ?>"><?= h($e['matricule']) ?></a></td>
      <td><?= h($e['nom']) ?></td><td><?= h($e['prenom']) ?></td><td><?= h($e['filiere']) ?></td></tr>
<?php endforeach; ?>
</table>
<?php endif; pied();
