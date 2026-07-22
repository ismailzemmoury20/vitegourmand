<?php ob_start(); ?>
<section class="auth">
    <div class="carte auth-carte">
        <h1>Contact</h1>
        <p class="auth-sous-titre">Vite &amp; Gourmand</p>
        <?php if (!empty($error)): ?>
            <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <p class="message message-succes"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <form method="post" action="">
            <label for="titre">Sujet</label>
            <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="6" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
            <button type="submit" class="bouton">Envoyer</button>
        </form>
    </div>
</section>
<?php
$contenu = ob_get_clean();
$titre = ($pageTitle ?? 'Contact') . ' - Vite & Gourmand';
$style = 'contact.css';
require __DIR__ . '/../templates/layout-public.php';
