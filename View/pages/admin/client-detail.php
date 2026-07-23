<?php ob_start(); ?>
<h1 class="espace-titre">Client <?= htmlspecialchars($client['prenom'] . ' ' . $client['nom']) ?></h1>
<div class="suivi-conteneur">
    <div class="infos-carte suivi-carte">
        <h2 class="suivi-sous-titre">Informations</h2>
        <p class="suivi-ligne"><span>Nom</span><span><?= htmlspecialchars($client['prenom'] . ' ' . $client['nom']) ?></span></p>
        <p class="suivi-ligne"><span>Email</span><span><?= htmlspecialchars($client['email']) ?></span></p>
        <p class="suivi-ligne"><span>Téléphone</span><span><?= htmlspecialchars($client['telephone'] ?? '') ?></span></p>
        <p class="suivi-ligne"><span>Adresse</span><span><?= htmlspecialchars(trim(($client['numero_rue'] ?? '') . ' ' . ($client['rue'] ?? '') . ', ' . ($client['adresse_postale'] ?? '') . ' ' . ($client['ville'] ?? ''), ' ,')) ?></span></p>
        <p class="suivi-ligne"><span>Inscrit le</span><span><?= date('d/m/Y', strtotime($client['date_creation'])) ?></span></p>
        <p class="suivi-ligne"><span>Statut</span><span class="suivi-statut"><?= $client['actif'] ? 'Actif' : 'Bloqué' ?></span></p>
    </div>
    <div class="infos-carte suivi-carte">
        <h2 class="suivi-sous-titre">Historique des commandes</h2>
        <?php if (empty($commandes)): ?>
            <p class="suivi-vide">Aucune commande pour ce client.</p>
        <?php else: ?>
            <?php foreach ($commandes as $commande): ?>
                <p class="suivi-ligne">
                    <span><?= htmlspecialchars($commande['numero_commande']) ?> — <?= htmlspecialchars($commande['titre_menu']) ?></span>
                    <span><?= htmlspecialchars($commande['statut']) ?> · <?= number_format((float) $commande['prix_menu'] + (float) $commande['prix_livraison'], 2, ',', ' ') ?> €</span>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<p class="suivi-retour"><a href="/index.php?p=admin-clients">Retour aux clients</a></p>
<?php
$contenu = ob_get_clean();
$titre = 'Détail du client - Vite & Gourmand';
$pageActive = 'clients';
$style = 'suivi-commande.css';
require __DIR__ . '/../../templates/layout-admin.php';
