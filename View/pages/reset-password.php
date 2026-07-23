<?php ob_start(); ?>
<section class="auth">
    <div class="carte auth-carte">
        <h1>Réinitialiser le mot de passe</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <?php if (!empty($error)): ?>
            <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
            <p class="message message-succes"><?= htmlspecialchars($message) ?></p>
            <p class="auth-lien"><a href="/index.php?p=login">Se connecter</a></p>
        <?php else: ?>
            <form method="post" action="">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" id="password" name="password" minlength="8" required>
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>
                <button type="submit" class="bouton">Réinitialiser</button>
            </form>
        <?php endif; ?>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = 'Réinitialiser le mot de passe - Vite & Gourmand';
require __DIR__ . '/../templates/layout-public.php';
