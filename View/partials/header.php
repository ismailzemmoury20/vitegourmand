<?php $roleId = (int) ($_SESSION['role_id'] ?? 0); ?>
<?php $estConnecte = !empty($_SESSION['utilisateur_id']) && in_array($roleId, [1, 2, 3], true); ?>
<header class="entete">
    <h1><a href="/vitegourmand/public/index.php?p=home">Vite &amp; Gourmand</a></h1>
    <button type="button" class="menu-toggle" id="menu-toggle" aria-label="Ouvrir le menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <nav class="entete-nav" id="entete-nav">
        <a href="/vitegourmand/public/index.php?p=home">Accueil</a>
        <a href="/vitegourmand/public/index.php?p=menus">Menus</a>
        <a href="/vitegourmand/public/index.php?p=contact">Contact</a>
        <?php if ($estConnecte): ?>
            <?php if ($roleId === 1): ?>
                <a href="/vitegourmand/public/index.php?p=admin-dashboard">Mon espace</a>
            <?php elseif ($roleId === 3): ?>
                <a href="/vitegourmand/public/index.php?p=employe-commandes">Mon espace</a>
            <?php else: ?>
                <a href="/vitegourmand/public/index.php?p=commandes">Mon espace</a>
            <?php endif; ?>
            <a class="bouton" href="/vitegourmand/public/index.php?p=logout">Déconnexion</a>
        <?php else: ?>
            <a class="bouton" href="/vitegourmand/public/index.php?p=login">Connexion</a>
        <?php endif; ?>
    </nav>
</header>
<div class="sidebar-overlay" id="sidebar-overlay"></div>
