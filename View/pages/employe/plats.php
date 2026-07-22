<?php ob_start(); ?>
<div class="espace-entete">
    <h1 class="espace-titre">Plats</h1>
    <button type="button" class="bouton" data-popup="popup-plat-ajouter">Ajouter un plat</button>
</div>
<div class="tableau-conteneur">
<table class="tableau">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Titre</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($plats as $plat): ?>
            <tr>
                <td data-label="Photo">
                    <?php if (!empty($plat['photo'])): ?>
                        <img class="photo-plat" src="data:image/jpeg;base64,<?= base64_encode($plat['photo']) ?>" alt="<?= htmlspecialchars($plat['titre_plat']) ?>">
                    <?php endif; ?>
                </td>
                <td data-label="Titre"><?= htmlspecialchars($plat['titre_plat']) ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <button type="button" class="bouton bouton-petit ouvrir-plat-modifier" data-popup="popup-plat-modifier" data-id="<?= (int) $plat['plat_id'] ?>" data-titre="<?= htmlspecialchars($plat['titre_plat']) ?>">Modifier</button>
                        <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-plat-supprimer" data-popup="popup-plat-supprimer" data-id="<?= (int) $plat['plat_id'] ?>" data-titre="<?= htmlspecialchars($plat['titre_plat']) ?>">Supprimer</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-plat-ajouter.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-plat-modifier.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-plat-supprimer.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Plats - Vite & Gourmand';
$pageActive = 'plats';
$script = 'employe-plats.js';
require __DIR__ . '/../../templates/layout-employe.php';
