<?php ob_start(); ?>
<section class="auth">
    <div class="carte auth-carte">
        <h1>Mot de passe oublié</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <?php if (!empty($error)): ?>
            <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($message)): ?>
            <p class="message message-succes"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <button type="submit" class="bouton">Envoyer le lien</button>
        </form>
        <p class="auth-lien"><a href="/vitegourmand/public/index.php?p=login">Retour à la connexion</a></p>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = 'Mot de passe oublié - Vite & Gourmand';
require __DIR__ . '/../templates/layout-public.php';
