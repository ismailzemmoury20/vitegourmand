<?php ob_start(); ?>
<div class="espace-entete">
    <h1 class="espace-titre">Mes commandes</h1>
    <a class="bouton" href="/index.php?p=commande">Ajouter une commande</a>
</div>
<?php if (!empty($success)): ?>
    <p class="message message-succes"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>
<div class="tableau-conteneur">
<table class="tableau">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Menu</th>
            <th>Statut</th>
            <th>Date</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes ?? [] as $commande): ?>
            <tr>
                <td data-label="Numéro"><?= htmlspecialchars($commande['numero_commande']) ?></td>
                <td data-label="Menu"><?= htmlspecialchars($commande['titre_menu']) ?></td>
                <td class="td-nowrap" data-label="Statut"><?= htmlspecialchars($commande['statut']) ?></td>
                <td class="td-nowrap" data-label="Date"><?= date('d/m/Y', strtotime($commande['date_commande'])) ?></td>
                <td class="td-nowrap" data-label="Total"><?= number_format((float) $commande['prix_menu'] + (float) ($commande['prix_livraison'] ?? 0), 2, ',', ' ') ?> €</td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <a class="bouton bouton-petit" href="/index.php?p=suivi-commande&numero=<?= urlencode($commande['numero_commande']) ?>">Détails</a>
                        <?php if ($commande['statut'] !== 'annulée'): ?>
                            <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-popup-annuler" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>" data-statut="<?= htmlspecialchars($commande['statut']) ?>" data-url="/index.php?p=commandes&action=annuler&numero=<?= urlencode($commande['numero_commande']) ?>">Annuler</button>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<div class="pagination">
    <?php for ($i = 1; $i <= ($totalPages ?? 1); $i++): ?>
        <a class="pagination-lien <?= $i === ($page ?? 1) ? 'actif' : '' ?>" href="/index.php?p=commandes&page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-annuler-commande-client.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Mes commandes - Vite & Gourmand';
$pageActive = 'commandes';
$script = 'commandes.js';
require __DIR__ . '/../../templates/layout-user.php';
