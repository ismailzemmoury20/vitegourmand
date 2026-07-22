<aside class="sidebar">
    <a class="logo" href="/vitegourmand/public/index.php?p=home">Vite &amp; Gourmand</a>
    <nav class="sidebar-nav">
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'commandes' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=employe-commandes">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l1 14H5L6 7z"/><path d="M9 7V5a3 3 0 0 1 6 0v2"/></svg>
            Commandes
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'menus' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=employe-menus">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>
            Menus
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'plats' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=employe-plats">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/></svg>
            Plats
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'horaires' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=employe-horaires">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
            Horaires
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'avis' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=employe-avis-clients">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.7 5.5 6.3.9-4.5 4.4 1 6.2-5.5-2.9-5.5 2.9 1-6.2L3 9.4l6.3-.9L12 3z"/></svg>
            Avis clients
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'deconnexion' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4H5v16h10"/><path d="M13 12h8"/><path d="M18 9l3 3-3 3"/></svg>
            Déconnexion
        </a>
    </nav>
    <div class="sidebar-bas">
        <span class="sidebar-avatar"><?= strtoupper(substr($_SESSION['email'] ?? 'E', 0, 1)) ?></span>
        <span><?= htmlspecialchars($_SESSION['email'] ?? '') ?></span>
    </div>
</aside>
