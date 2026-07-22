<?php $suite = isset($_GET['redirect']) ? '&redirect=' . urlencode($_GET['redirect']) . '&menu_id=' . (int) ($_GET['menu_id'] ?? 0) : ''; ?>
<?php ob_start(); ?>
<section class="auth">
    <div class="carte auth-carte">
        <h1>Connexion</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <?php if (!empty($error)): ?>
            <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])): ?>
            <p class="message message-succes"><?= htmlspecialchars($_SESSION['success']) ?></p>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        <form method="post" action="">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="bouton">Se connecter</button>
        </form>
        <p class="auth-lien"><a href="/vitegourmand/public/index.php?p=forgot-password">Mot de passe oublié ?</a></p>
        <p class="auth-lien">Pas de compte ? <a href="/vitegourmand/public/index.php?p=register<?= $suite ?>">S'inscrire</a></p>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = 'Connexion - Vite & Gourmand';
require __DIR__ . '/../templates/layout-public.php';
