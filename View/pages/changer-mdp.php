<?php ob_start(); ?>
<section class="auth">
    <div class="carte auth-carte">
        <h1>Changer mon mot de passe</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <p class="changer-mdp-info">Pour des raisons de sécurité, vous devez définir un nouveau mot de passe avant de continuer.</p>
        <?php if (!empty($error)): ?>
            <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Minimum 10 caractères" minlength="10" required>
            <label for="password_confirm">Confirmer le mot de passe</label>
            <input type="password" id="password_confirm" name="password_confirm" minlength="10" required>
            <button type="submit" class="bouton">Enregistrer</button>
        </form>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = 'Changer mon mot de passe - Vite & Gourmand';
$style = 'changer-mdp.css';
require __DIR__ . '/../templates/layout-public.php';
