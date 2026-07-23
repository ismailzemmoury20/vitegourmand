<?php $statutSuivant = $commande['statut_suivant'] ?? null; ?>
<?php $estAdmin = (int) ($_SESSION['role_id'] ?? 0) === 1; ?>
<?php ob_start(); ?>
<div class="espace-entete">
    <h1 class="espace-titre">Commande <?= htmlspecialchars($commande['numero_commande']) ?></h1>
    <div class="tableau-actions">
        <?php if ($estAdmin && $commande['statut'] !== 'annulée'): ?>
            <button type="button" class="bouton bouton-petit ouvrir-statut" data-popup="popup-statut" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>" data-actuel="<?= htmlspecialchars($commande['statut']) ?>" data-pret-materiel="<?= (int) $commande['pret_materiel'] ?>">Modifier statut</button>
        <?php elseif (!$estAdmin && $statutSuivant): ?>
            <button type="button" class="bouton bouton-petit ouvrir-statut" data-popup="popup-statut" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>" data-actuel="<?= htmlspecialchars($commande['statut']) ?>" data-suivant="<?= htmlspecialchars($statutSuivant) ?>">Statut suivant</button>
        <?php endif; ?>
        <?php if (!in_array($commande['statut'], $estAdmin ? ['annulée'] : ['livrée', 'annulée'], true)): ?>
            <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-annulation" data-popup="popup-annuler-employe" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>">Annuler</button>
        <?php endif; ?>
    </div>
</div>
<div class="suivi-conteneur">
    <div class="infos-carte suivi-carte">
        <h2 class="suivi-sous-titre">Client</h2>
        <p class="suivi-ligne"><span>Nom</span><span><?= htmlspecialchars($commande['prenom_client'] . ' ' . $commande['nom_client']) ?></span></p>
        <p class="suivi-ligne"><span>Email</span><span><?= htmlspecialchars($commande['email_client']) ?></span></p>
        <p class="suivi-ligne"><span>Téléphone</span><span><?= htmlspecialchars($commande['telephone'] ?? '') ?></span></p>
        <p class="suivi-ligne"><span>Adresse</span><span><?= htmlspecialchars(trim(($commande['numero_rue'] ?? '') . ' ' . ($commande['rue'] ?? '') . ', ' . ($commande['adresse_postale'] ?? '') . ' ' . ($commande['ville'] ?? ''), ' ,')) ?></span></p>
        <h2 class="suivi-sous-titre suivi-espace">Commande</h2>
        <p class="suivi-ligne"><span>Menu</span><span><?= htmlspecialchars($commande['titre_menu']) ?></span></p>
        <p class="suivi-ligne"><span>Nombre de personnes</span><span><?= (int) $commande['nombre_personne'] ?></span></p>
        <p class="suivi-ligne"><span>Date de la prestation</span><span><?= date('d/m/Y', strtotime($commande['date_prestation'])) ?></span></p>
        <p class="suivi-ligne"><span>Heure de livraison</span><span><?= htmlspecialchars($commande['heure_livraison']) ?></span></p>
        <p class="suivi-ligne"><span>Prix du menu</span><span><?= number_format((float) $commande['prix_menu'], 2, ',', ' ') ?> €</span></p>
        <p class="suivi-ligne"><span>Frais de livraison</span><span><?= number_format((float) $commande['prix_livraison'], 2, ',', ' ') ?> €</span></p>
        <p class="suivi-ligne suivi-total"><span>Total</span><span><?= number_format((float) $commande['prix_menu'] + (float) $commande['prix_livraison'], 2, ',', ' ') ?> €</span></p>
        <p class="suivi-ligne"><span>Statut actuel</span><span class="suivi-statut"><?= htmlspecialchars($commande['statut']) ?></span></p>
        <?php if (!empty($commande['motif_annulation'])): ?>
            <p class="suivi-ligne"><span>Motif d'annulation</span><span><?= htmlspecialchars($commande['motif_annulation']) ?></span></p>
            <p class="suivi-ligne"><span>Mode de contact</span><span><?= htmlspecialchars($commande['mode_contact'] ?? '') ?></span></p>
        <?php endif; ?>
    </div>
    <div class="infos-carte suivi-carte">
        <h2 class="suivi-sous-titre">Historique de la commande</h2>
        <ul class="suivi-timeline">
            <?php foreach ($historique as $etape): ?>
                <li>
                    <span class="timeline-point"></span>
                    <div>
                        <p class="timeline-statut"><?= htmlspecialchars($etape['statut']) ?></p>
                        <p class="timeline-date"><?= date('d/m/Y à H:i', strtotime($etape['date_modification'])) ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<p class="suivi-retour"><a href="/index.php?p=employe-commandes">Retour aux commandes</a></p>
<?php require __DIR__ . '/../../partials/popups/popup-modifier-statut-commande.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-annuler-commande-employe.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Détail de la commande - Vite & Gourmand';
$pageActive = 'commandes';
$style = 'suivi-commande.css';
$script = 'employe-commandes.js';
require __DIR__ . '/../../templates/layout-employe.php';
