<?php
function lienTri(string $colonne, string $tri, string $sens): string
{
    $nouveauSens = ($tri === $colonne && $sens === 'desc') ? 'asc' : 'desc';
    $params = [
        'p'        => 'employe-commandes',
        'commande' => $_GET['commande'] ?? '',
        'statut'   => $_GET['statut'] ?? '',
        'tri'      => $colonne,
        'sens'     => $nouveauSens,
    ];
    return '/index.php?' . http_build_query($params);
}
$estAdmin = (int) ($_SESSION['role_id'] ?? 0) === 1;
ob_start();
?>
<h1 class="espace-titre">Commandes</h1>
<?php if (!empty($error)): ?>
    <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form class="filtres-barre" method="get" action="/index.php">
    <input type="hidden" name="p" value="employe-commandes">
    <input type="text" name="commande" placeholder="Rechercher un client" value="<?= htmlspecialchars($_GET['commande'] ?? '') ?>">
    <select name="statut">
        <option value="">Tous les statuts</option>
        <?php foreach (['en attente', 'en préparation', 'prête', 'livrée', 'annulée'] as $unStatut): ?>
            <option value="<?= $unStatut ?>" <?= ($_GET['statut'] ?? '') === $unStatut ? 'selected' : '' ?>><?= ucfirst($unStatut) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="bouton bouton-petit">Filtrer</button>
</form>
<div class="tableau-conteneur">
<table class="tableau tableau-commandes">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Client</th>
            <th>Menu</th>
            <th>Statut</th>
            <th><a class="tri-lien" href="<?= lienTri('date', $tri, $sens) ?>">Date</a></th>
            <th>Prestation</th>
            <th><a class="tri-lien" href="<?= lienTri('total', $tri, $sens) ?>">Total</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande): ?>
            <?php $statutSuivant = $commande['statut_suivant'] ?? null; ?>
            <tr>
                <td class="td-nowrap" data-label="Numéro"><?= htmlspecialchars($commande['numero_commande']) ?></td>
                <td data-label="Client">
                    <span class="td-valeur-groupe">
                        <?= htmlspecialchars($commande['prenom_client'] . ' ' . $commande['nom_client']) ?>
                        <span class="client-email"><?= htmlspecialchars($commande['email_client']) ?></span>
                    </span>
                </td>
                <td data-label="Menu"><?= htmlspecialchars($commande['titre_menu']) ?></td>
                <td data-label="Statut"><?= htmlspecialchars($commande['statut']) ?></td>
                <td class="td-nowrap" data-label="Date"><?= date('d/m/Y', strtotime($commande['date_commande'])) ?></td>
                <td class="td-nowrap" data-label="Prestation"><?= date('d/m/Y', strtotime($commande['date_prestation'])) ?></td>
                <td class="td-nowrap" data-label="Total"><?= number_format((float) $commande['prix_menu'] + (float) $commande['prix_livraison'], 2, ',', ' ') ?> €</td>
                <td class="td-actions">
                    <div class="tableau-actions">
                        <a class="bouton bouton-petit" href="/index.php?p=employe-commandes&action=detail&numero=<?= urlencode($commande['numero_commande']) ?>">Détails</a>
                        <?php if ($estAdmin && $commande['statut'] !== 'annulée'): ?>
                            <button type="button" class="bouton bouton-petit ouvrir-statut" data-popup="popup-statut" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>" data-actuel="<?= htmlspecialchars($commande['statut']) ?>" data-pret-materiel="<?= (int) $commande['pret_materiel'] ?>">Modifier statut</button>
                        <?php elseif (!$estAdmin && $statutSuivant): ?>
                            <button type="button" class="bouton bouton-petit ouvrir-statut" data-popup="popup-statut" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>" data-actuel="<?= htmlspecialchars($commande['statut']) ?>" data-suivant="<?= htmlspecialchars($statutSuivant) ?>">Statut suivant</button>
                        <?php endif; ?>
                        <?php if (!in_array($commande['statut'], $estAdmin ? ['annulée'] : ['livrée', 'annulée'], true)): ?>
                            <button type="button" class="bouton bouton-petit bouton-annuler ouvrir-annulation" data-popup="popup-annuler-employe" data-numero="<?= htmlspecialchars($commande['numero_commande']) ?>">Annuler</button>
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
        <a class="pagination-lien <?= $i === ($page ?? 1) ? 'actif' : '' ?>" href="/index.php?<?= http_build_query(['p' => 'employe-commandes', 'commande' => $_GET['commande'] ?? '', 'statut' => $_GET['statut'] ?? '', 'tri' => $tri, 'sens' => $sens, 'page' => $i]) ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>
<?php require __DIR__ . '/../../partials/popups/popup-modifier-statut-commande.php'; ?>
<?php require __DIR__ . '/../../partials/popups/popup-annuler-commande-employe.php'; ?>
<?php
$contenu = ob_get_clean();
$titre = 'Commandes - Vite & Gourmand';
$pageActive = 'commandes';
$script = 'employe-commandes.js';
require __DIR__ . '/../../templates/layout-employe.php';
