<?php
$pageTitle = 'Nos Menus - Vite & Gourmand';

ob_start();
?>

<div class="menu-title"><h2>Nos Menus</h2></div>
<p class="menus-description">Découvrez nos menus variés, adaptés à toutes les occasions.</p>

<div class="filtre">
    <p class="filtre-title">Filtres</p>
    <form id="filtre-form" method="get" action="/vitegourmand/public/index.php">
        <input type="hidden" name="p" value="menus">
        <div class="filtre-input">
            <label for="prix-max">Prix maximum</label>
            <input type="number" id="prix-max" name="prix_max" min="0" placeholder="Ex : 100">
        </div>
        <div class="filtre-input">
            <label for="prix-fourchette">Fourchette de prix</label>
            <input type="range" id="prix-fourchette" name="prix_fourchette" min="0" max="500" step="1" value="500">
            <div id="fourchette-valeur">500 €</div>
        </div>
        <div class="filtre-input">
            <label for="regime">Régime alimentaire</label>
            <select id="regime" name="regime">
                <option value="">Tous les régimes</option>
                <?php foreach ($regimes ?? [] as $unRegime): ?>
                    <option value="<?= htmlspecialchars($unRegime['libelle']) ?>"><?= htmlspecialchars($unRegime['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filtre-input-category">
            <label for="theme">Catégorie</label>
            <select id="theme" name="theme">
                <option value="">Toutes les catégories</option>
                <?php foreach ($themes ?? [] as $unTheme): ?>
                    <option value="<?= htmlspecialchars($unTheme['libelle']) ?>"><?= htmlspecialchars($unTheme['libelle']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" id="btn-chercher">Chercher</button>
    </form>
</div>

<div class="menus" id="liste-menus">
    <?php require __DIR__ . '/../partials/menus-liste.php'; ?>
</div>

<?php require __DIR__ . '/../partials/popups/popup-menu.php'; ?>

<?php
$contenu = ob_get_clean();
$titre = $pageTitle;
$script = 'menus-filtres.js';
require __DIR__ . '/../templates/layout-public.php';
?>
