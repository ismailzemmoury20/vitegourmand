<?php ob_start(); ?>
<h1 class="espace-titre">Avis clients</h1>
<div class="tableau-conteneur">
<table class="tableau">
    <thead>
        <tr>
            <th>Client</th>
            <th>Note</th>
            <th>Commentaire</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($avis as $unAvis): ?>
            <tr>
                <td data-label="Client"><?= htmlspecialchars($unAvis['nom']) ?></td>
                <td class="td-nowrap" data-label="Note"><?= str_repeat('★', (int) $unAvis['note']) . str_repeat('☆', 5 - (int) $unAvis['note']) ?></td>
                <td data-label="Commentaire"><?= htmlspecialchars($unAvis['description']) ?></td>
                <td class="td-nowrap" data-label="Statut"><?= htmlspecialchars($unAvis['statut']) ?></td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <?php if ($unAvis['statut'] === 'en attente'): ?>
                            <form method="post" action="">
                                <input type="hidden" name="avis_id" value="<?= (int) $unAvis['avis_id'] ?>">
                                <input type="hidden" name="action" value="valider">
                                <button type="submit" class="bouton bouton-petit">Valider</button>
                            </form>
                            <form method="post" action="">
                                <input type="hidden" name="avis_id" value="<?= (int) $unAvis['avis_id'] ?>">
                                <input type="hidden" name="action" value="refuser">
                                <button type="submit" class="bouton bouton-petit bouton-annuler">Refuser</button>
                            </form>
                        <?php endif; ?>
                        <form method="post" action="">
                            <input type="hidden" name="avis_id" value="<?= (int) $unAvis['avis_id'] ?>">
                            <input type="hidden" name="action" value="supprimer">
                            <button type="submit" class="bouton bouton-petit bouton-annuler">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php
$contenu = ob_get_clean();
$titre = 'Avis clients - Vite & Gourmand';
$pageActive = 'avis';
require __DIR__ . '/../../templates/layout-employe.php';
