<?php ob_start(); ?>
<h1 class="espace-titre">Horaires</h1>
<div class="tableau-conteneur">
<table class="tableau">
    <thead>
        <tr>
            <th>Jour</th>
            <th>Ouverture</th>
            <th>Fermeture</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($horaires as $horaire): ?>
            <tr>
                <td data-label="Jour"><?= htmlspecialchars($horaire['jour']) ?></td>
                <td class="td-nowrap" data-label="Ouverture"><?= htmlspecialchars($horaire['heure_ouverture']) ?></td>
                <td class="td-nowrap" data-label="Fermeture"><?= htmlspecialchars($horaire['heure_fermeture']) ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <button type="button" class="bouton bouton-petit ouvrir-horaire-modifier" data-popup="popup-horaire-modifier" data-id="<?= (int) $horaire['horaire_id'] ?>" data-jour="<?= htmlspecialchars($horaire['jour']) ?>" data-ouverture="<?= htmlspecialchars($horaire['heure_ouverture']) ?>" data-fermeture="<?= htmlspecialchars($horaire['heure_fermeture']) ?>">Modifier</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-horaire-modifier.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Horaires - Vite & Gourmand';
$pageActive = 'horaires';
$script = 'employe-horaires.js';
require __DIR__ . '/../../templates/layout-employe.php';
