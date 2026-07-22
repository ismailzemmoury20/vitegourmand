<?php ob_start(); ?>
<div class="espace-entete">
    <h1 class="espace-titre">Gestion des menus</h1>
    <a class="bouton" href="/vitegourmand/public/index.php?p=admin-menus&action=ajouter">+ Ajouter un menu</a>
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
            <th>Titre</th>
            <th>Prix par personne</th>
            <th>Quantité restante</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
            <tr>
                <td data-label="Titre"><?= htmlspecialchars($menu['titre']) ?></td>
                <td class="td-nowrap" data-label="Prix par personne"><?= number_format((float) $menu['prix_par_personne'], 2, ',', ' ') ?> €</td>
                <td data-label="Quantité restante"><?= (int) $menu['quantite_restante'] ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <button type="button" class="bouton bouton-petit ouvrir-menu-modifier" data-popup="popup-menu-modifier" data-id="<?= (int) $menu['menu_id'] ?>" data-titre="<?= htmlspecialchars($menu['titre']) ?>" data-prix="<?= (float) $menu['prix_par_personne'] ?>" data-stock="<?= (int) $menu['quantite_restante'] ?>">Modifier</button>
                        <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-menu-supprimer" data-popup="popup-menu-supprimer" data-id="<?= (int) $menu['menu_id'] ?>" data-titre="<?= htmlspecialchars($menu['titre']) ?>">Supprimer</button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-menu-modifier.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-menu-supprimer.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Gestion des menus - Vite & Gourmand';
$pageActive = 'menus';
$script = 'employe-menus.js';
require __DIR__ . '/../../templates/layout-admin.php';
