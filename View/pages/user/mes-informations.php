<?php ob_start(); ?>
<h1 class="espace-titre">Mes informations</h1>
<?php if (!empty($error)): ?>
    <p class="message message-erreur"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<?php if (!empty($success)): ?>
    <p class="message message-succes"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>
<div class="infos-carte">
    <form method="post" action="">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($utilisateur['nom'] ?? '') ?>" required>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($utilisateur['prenom'] ?? '') ?>" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($utilisateur['email'] ?? '') ?>" required>
        <label for="password-actuel">Mot de passe actuel (requis pour modifier)</label>
        <input type="password" id="password-actuel" name="password_actuel" required>
        <label for="password-nouveau">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
        <input type="password" id="password-nouveau" name="password_nouveau" placeholder="Nouveau mot de passe" minlength="10">
        <button type="submit" class="bouton">Enregistrer</button>
    </form>
</div>
<?php
$contenu = ob_get_clean();
$titre = 'Mes informations - Vite & Gourmand';
$pageActive = 'informations';
require __DIR__ . '/../../templates/layout-user.php';
