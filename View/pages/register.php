<?php $suite = isset($_GET['redirect']) ? '&redirect=' . urlencode($_GET['redirect']) . '&menu_id=' . (int) ($_GET['menu_id'] ?? 0) : ''; ?>
<?php ob_start(); ?>
<section class="auth">
    <div class="carte auth-carte">
        <h1>Créer un compte</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <?php if (!empty($error)): ?>
            <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="message message-succes"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <div class="auth-champs">
                <div class="champ">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>" required>
                </div>
                <div class="champ">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>" required>
                </div>
                <div class="champ">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>" required>
                </div>
                <div class="champ">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
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
                    <label for="adresse_complementaire">Complément d'adresse</label>
                    <input type="text" id="adresse_complementaire" name="adresse_complementaire" value="<?= htmlspecialchars($_POST['adresse_complementaire'] ?? '') ?>">
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
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Minimum 10 caractères" minlength="10" required>
                </div>
                <div class="champ">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm" minlength="10" required>
                </div>
            </div>
            <button type="submit" class="bouton">Créer mon compte</button>
        </form>
        <p class="auth-lien">Déjà un compte ? <a href="/index.php?p=login<?= $suite ?>">Se connecter</a></p>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = 'Créer un compte - Vite & Gourmand';
$style = 'register.css';
require __DIR__ . '/../templates/layout-public.php';
