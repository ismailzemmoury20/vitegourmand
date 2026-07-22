<?php ob_start(); ?>
<div class="espace-entete">
    <h1 class="espace-titre">Gestion des employés</h1>
    <button type="button" class="bouton" data-popup="popup-employe-ajouter">Créer un compte employé</button>
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
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employes as $employe): ?>
            <tr>
                <td data-label="Nom"><?= htmlspecialchars($employe['nom']) ?></td>
                <td data-label="Prénom"><?= htmlspecialchars($employe['prenom']) ?></td>
                <td data-label="Email"><?= htmlspecialchars($employe['email']) ?></td>
                <td class="td-nowrap" data-label="Statut"><?= $employe['actif'] ? 'Actif' : 'Inactif' ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <button type="button" class="bouton bouton-petit ouvrir-employe-modifier" data-popup="popup-employe-modifier" data-id="<?= (int) $employe['utilisateur_id'] ?>" data-nom="<?= htmlspecialchars($employe['nom']) ?>" data-prenom="<?= htmlspecialchars($employe['prenom']) ?>" data-email="<?= htmlspecialchars($employe['email']) ?>">Modifier</button>
                        <button type="button" class="bouton bouton-petit ouvrir-employe-reinitialiser" data-popup="popup-employe-reinitialiser" data-id="<?= (int) $employe['utilisateur_id'] ?>" data-nom="<?= htmlspecialchars($employe['prenom'] . ' ' . $employe['nom']) ?>">Réinitialiser le mot de passe</button>
                        <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-employe-actif" data-popup="popup-employe-desactiver-activer" data-id="<?= (int) $employe['utilisateur_id'] ?>" data-nom="<?= htmlspecialchars($employe['prenom'] . ' ' . $employe['nom']) ?>" data-action="<?= $employe['actif'] ? 'desactiver' : 'activer' ?>"><?= $employe['actif'] ? 'Désactiver' : 'Activer' ?></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-employe-ajouter.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-employe-modifier.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-employe-reinitialiser.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-employe-desactiver-activer.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Gestion des employés - Vite & Gourmand';
$pageActive = 'employes';
$script = 'admin-employes.js';
require __DIR__ . '/../../templates/layout-admin.php';
