<?php ob_start(); ?>
<h1 class="espace-titre">Ajouter un menu</h1>
<?php if (!empty($error)): ?>
    <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<div class="infos-carte ajout-menu-carte">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="ajout-menu-champs">
            <div class="champ-menu champ-menu-large">
                <label for="titre">Titre du menu</label>
                <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" required>
            </div>
            <div class="champ-menu champ-menu-large">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            </div>
            <div class="champ-menu champ-menu-large">
                <label for="conditions">Conditions du menu (délai de commande, précautions de stockage...)</label>
                <textarea id="conditions" name="conditions" rows="3"><?= htmlspecialchars($_POST['conditions'] ?? '') ?></textarea>
            </div>
            <div class="champ-menu">
                <label for="nombre_personne_minimum">Nombre de personnes minimum</label>
                <input type="number" id="nombre_personne_minimum" name="nombre_personne_minimum" min="1" value="<?= htmlspecialchars($_POST['nombre_personne_minimum'] ?? '') ?>" required>
            </div>
            <div class="champ-menu">
                <label for="prix_par_personne">Prix par personne (€)</label>
                <input type="number" id="prix_par_personne" name="prix_par_personne" min="0" step="0.01" value="<?= htmlspecialchars($_POST['prix_par_personne'] ?? '') ?>" required>
            </div>
            <div class="champ-menu">
                <label for="quantite_restante">Stock disponible</label>
                <input type="number" id="quantite_restante" name="quantite_restante" min="0" value="<?= htmlspecialchars($_POST['quantite_restante'] ?? '') ?>" required>
            </div>
            <div class="champ-menu">
                <label for="photos">Galerie d'images</label>
                <input type="file" id="photos" name="photos[]" multiple accept="image/*">
            </div>
            <div class="champ-menu champ-menu-large">
                <p class="choix-titre">Thèmes</p>
                <div class="choix-groupe">
                    <?php foreach ($themes as $unTheme): ?>
                        <label class="choix">
                            <input type="checkbox" name="themes[]" value="<?= (int) $unTheme['theme_id'] ?>">
                            <?= htmlspecialchars($unTheme['libelle']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="champ-menu champ-menu-large">
                <p class="choix-titre">Régimes</p>
                <div class="choix-groupe">
                    <?php foreach ($regimes as $unRegime): ?>
                        <label class="choix">
                            <input type="checkbox" name="regimes[]" value="<?= (int) $unRegime['regime_id'] ?>">
                            <?= htmlspecialchars($unRegime['libelle']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="champ-menu champ-menu-large">
                <p class="choix-titre">Plats du menu</p>
                <div class="choix-groupe">
                    <?php foreach ($plats as $plat): ?>
                        <label class="choix">
                            <input type="checkbox" name="plats[]" value="<?= (int) $plat['plat_id'] ?>">
                            <?= htmlspecialchars($plat['titre_plat']) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <button type="submit" class="bouton">Créer le menu</button>
    </form>
    <p class="ajout-menu-retour"><a href="/vitegourmand/public/index.php?p=admin-menus">Retour aux menus</a></p>
</div>
<?php
$contenu = ob_get_clean();
$titre = 'Ajouter un menu - Vite & Gourmand';
$pageActive = 'menus';
$style = 'menu-ajouter.css';
require __DIR__ . '/../../templates/layout-admin.php';
