<?php ob_start(); ?>
<section class="commande">
    <div class="carte commande-carte">
        <h1>Confirmer ma commande</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <?php if (!empty($menu)): ?>
            <div class="commande-menu">
                <h2><?= htmlspecialchars($menu['titre']) ?></h2>
                <p class="commande-menu-prix"><?= number_format((float) $menu['prix_par_personne'], 2, ',', ' ') ?> € / personne</p>
                <p class="commande-menu-minimum">Minimum <?= (int) $menu['nombre_personne_minimum'] ?> personnes</p>
            </div>
            <?php if (!empty($error)): ?>
                <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form method="post" action="" id="commande-form"
                  data-prix="<?= (float) $menu['prix_par_personne'] ?>"
                  data-minimum="<?= (int) $menu['nombre_personne_minimum'] ?>">
                <input type="hidden" name="menu_id" value="<?= (int) $menu['menu_id'] ?>">
                <div class="commande-champs">
                    <div class="champ">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="numero_rue">Numéro de rue</label>
                        <input type="text" id="numero_rue" name="numero_rue" value="<?= htmlspecialchars($_POST['numero_rue'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="rue">Rue</label>
                        <input type="text" id="rue" name="rue" value="<?= htmlspecialchars($_POST['rue'] ?? '') ?>" required>
                    </div>
                    <div class="champ champ-large">
                        <label for="complementaire">Complément d'adresse</label>
                        <input type="text" id="complementaire" name="complementaire" value="<?= htmlspecialchars($_POST['complementaire'] ?? '') ?>">
                    </div>
                    <div class="champ">
                        <label for="code_postale">Code postal</label>
                        <input type="text" id="code_postale" name="code_postale" value="<?= htmlspecialchars($_POST['code_postale'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="ville">Ville</label>
                        <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($_POST['ville'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="date">Date de la prestation</label>
                        <input type="date" id="date" name="date" value="<?= htmlspecialchars($_POST['date'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="livraison">Heure de livraison</label>
                        <input type="time" id="livraison" name="livraison" value="<?= htmlspecialchars($_POST['livraison'] ?? '') ?>" required>
                    </div>
                    <div class="champ">
                        <label for="number">Nombre de personnes</label>
                        <input type="number" id="number" name="number" min="<?= (int) $menu['nombre_personne_minimum'] ?>" value="<?= htmlspecialchars($_POST['number'] ?? $menu['nombre_personne_minimum']) ?>" required>
                    </div>
                    <div class="champ" id="champ-distance">
                        <label for="distance">Distance depuis Bordeaux (km)</label>
                        <input type="number" id="distance" name="distance" min="0" step="0.1" value="<?= htmlspecialchars($_POST['distance'] ?? '') ?>">
                    </div>
                </div>
                <?php $prix_initial = (float) $menu['prix_par_personne'] * (int) ($_POST['number'] ?? $menu['nombre_personne_minimum']); ?>
                <div class="commande-recap">
                    <p><span>Prix de base</span><span id="prix-base"><?= number_format($prix_initial, 2, ',', ' ') ?> €</span></p>
                    <p><span>Réduction</span><span id="reduction">- 0,00 €</span></p>
                    <p><span>Frais de livraison</span><span id="frais-livraison">0,00 €</span></p>
                    <p class="recap-total"><span>Total</span><span id="total"><?= number_format($prix_initial, 2, ',', ' ') ?> €</span></p>
                </div>
                <button type="submit" class="bouton">Confirmer la commande</button>
            </form>
        <?php else: ?>
            <p class="commande-choix">Pour passer une commande, choisissez d'abord un menu.</p>
            <a class="bouton" href="/index.php?p=menus">Voir nos menus</a>
        <?php endif; ?>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = 'Confirmer ma commande - Vite & Gourmand';
$style = 'confirmer-commande.css';
$script = 'confirmer-commande.js';
require __DIR__ . '/../../templates/layout-public.php';
