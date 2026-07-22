<?php ob_start(); ?>
<div class="espace-entete">
    <h1 class="espace-titre">Administrateurs</h1>
    <button type="button" class="bouton" data-popup="popup-admin-ajouter">Créer un administrateur</button>
</div>
<?php if (!empty($success)): ?>
    <p class="message message-succes"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<div class="tableau-conteneur">
<table class="tableau">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Créé le</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td data-label="Nom"><?= htmlspecialchars($admin['nom']) ?></td>
                <td data-label="Prénom"><?= htmlspecialchars($admin['prenom']) ?></td>
                <td data-label="Email"><?= htmlspecialchars($admin['email']) ?></td>
                <td class="td-nowrap" data-label="Créé le"><?= date('d/m/Y', strtotime($admin['date_creation'])) ?></td>
                <td class="td-nowrap" data-label="Statut"><?= $admin['actif'] ? 'Actif' : 'Inactif' ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-admin-actif" data-popup="popup-admin-desactiver-activer" data-id="<?= (int) $admin['utilisateur_id'] ?>" data-nom="<?= htmlspecialchars($admin['prenom'] . ' ' . $admin['nom']) ?>" data-action="<?= $admin['actif'] ? 'desactiver' : 'activer' ?>"><?= $admin['actif'] ? 'Désactiver' : 'Activer' ?></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-admin-ajouter.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-admin-desactiver-activer.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Administrateurs - Vite & Gourmand';
$pageActive = 'admins';
$script = 'admin-admins.js';
require __DIR__ . '/../../templates/layout-admin.php';
