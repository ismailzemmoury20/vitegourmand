<?php ob_start(); ?>
<h1 class="espace-titre">Tableau de bord</h1>
<div class="stats-grille">
    <div class="stat-carte">
        <p class="stat-label">Chiffre d'affaires total</p>
        <p class="stat-valeur"><?= number_format((float) $chiffre_affaire, 2, ',', ' ') ?> €</p>
    </div>
    <div class="stat-carte">
        <p class="stat-label">CA du mois</p>
        <p class="stat-valeur"><?= number_format((float) $ca_actuel, 2, ',', ' ') ?> €</p>
    </div>
    <div class="stat-carte">
        <p class="stat-label">CA du mois précédent</p>
        <p class="stat-valeur"><?= number_format((float) $ca_precedent, 2, ',', ' ') ?> €</p>
    </div>
    <div class="stat-carte">
        <p class="stat-label">Évolution</p>
        <p class="stat-valeur <?= $taux >= 0 ? 'stat-hausse' : 'stat-baisse' ?>"><?= ($taux >= 0 ? '+' : '') . number_format((float) $taux, 1, ',', ' ') ?> %</p>
    </div>
</div>
<div class="dashboard-grille">
    <div class="infos-carte dashboard-carte">
        <h2 class="suivi-sous-titre">Commandes par menu</h2>
        <div class="graphique-conteneur">
            <canvas id="graphique-commandes" data-labels='<?= htmlspecialchars(json_encode($labels), ENT_QUOTES) ?>' data-valeurs='<?= htmlspecialchars(json_encode($data), ENT_QUOTES) ?>'></canvas>
        </div>
    </div>
    <div class="infos-carte dashboard-carte">
        <h2 class="suivi-sous-titre">Chiffre d'affaires par menu</h2>
        <form class="filtres-ca" method="get" action="/vitegourmand/public/index.php">
            <input type="hidden" name="p" value="admin-dashboard">
            <div class="filtre-ca-champ">
                <label for="ca-menu">Menu</label>
                <select id="ca-menu" name="menu_id">
                    <option value="">Tous les menus</option>
                    <?php foreach ($tousLesMenus as $unMenu): ?>
                        <option value="<?= (int) $unMenu['menu_id'] ?>" <?= (int) ($_GET['menu_id'] ?? 0) === (int) $unMenu['menu_id'] ? 'selected' : '' ?>><?= htmlspecialchars($unMenu['titre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filtre-ca-champ">
                <label for="ca-date-debut">Du</label>
                <input type="date" id="ca-date-debut" name="date_debut" value="<?= htmlspecialchars($_GET['date_debut'] ?? '') ?>">
            </div>
            <div class="filtre-ca-champ">
                <label for="ca-date-fin">Au</label>
                <input type="date" id="ca-date-fin" name="date_fin" value="<?= htmlspecialchars($_GET['date_fin'] ?? '') ?>">
            </div>
            <button type="submit" class="bouton bouton-petit filtre-ca-bouton">Filtrer</button>
        </form>
        <?php if (empty($ca_par_menu)): ?>
            <p class="dashboard-vide">Aucun chiffre d'affaires sur cette période.</p>
        <?php else: ?>
            <table class="tableau tableau-ca">
                <thead>
                    <tr>
                        <th>Menu</th>
                        <th>Chiffre d'affaires</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ca_par_menu as $ligne): ?>
                        <tr>
                            <td data-label="Menu"><?= htmlspecialchars($ligne['titre']) ?></td>
                            <td class="td-nowrap ca-montant" data-label="Chiffre d'affaires"><?= number_format((float) $ligne['total_ca'], 2, ',', ' ') ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$contenu = ob_get_clean();
$titre = 'Tableau de bord - Vite & Gourmand';
$pageActive = 'dashboard';
$style = 'dashboard.css';
$script = 'dashboard.js';
require __DIR__ . '/../../templates/layout-admin.php';
