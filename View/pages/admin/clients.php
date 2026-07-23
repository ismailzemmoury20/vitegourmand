<?php ob_start(); ?>
<h1 class="espace-titre">Gestion des clients</h1>
<div class="tableau-conteneur">
<table class="tableau">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Inscrit le</th>
            <th>Commandes</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td data-label="Nom"><?= htmlspecialchars($client['nom']) ?></td>
                <td data-label="Prénom"><?= htmlspecialchars($client['prenom']) ?></td>
                <td data-label="Email"><?= htmlspecialchars($client['email']) ?></td>
                <td class="td-nowrap" data-label="Inscrit le"><?= date('d/m/Y', strtotime($client['date_creation'])) ?></td>
                <td data-label="Commandes"><?= (int) $client['nb_commandes'] ?></td>
                <td class="td-nowrap" data-label="Statut"><?= $client['actif'] ? 'Actif' : 'Bloqué' ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <a class="bouton bouton-petit" href="/index.php?p=admin-clients&action=detail&id=<?= (int) $client['utilisateur_id'] ?>">Détails</a>
                        <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-client-bloquer" data-popup="popup-client-bloquer" data-id="<?= (int) $client['utilisateur_id'] ?>" data-nom="<?= htmlspecialchars($client['prenom'] . ' ' . $client['nom']) ?>" data-action="<?= $client['actif'] ? 'bloquer' : 'debloquer' ?>"><?= $client['actif'] ? 'Bloquer' : 'Débloquer' ?></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-client-bloquer.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Gestion des clients - Vite & Gourmand';
$pageActive = 'clients';
$script = 'admin-clients.js';
require __DIR__ . '/../../templates/layout-admin.php';
