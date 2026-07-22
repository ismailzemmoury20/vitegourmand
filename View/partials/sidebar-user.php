<aside class="sidebar">
    <a class="logo" href="/vitegourmand/public/index.php?p=home">Vite &amp; Gourmand</a>
    <nav class="sidebar-nav">
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'commandes' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=commandes">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l1 14H5L6 7z"/><path d="M9 7V5a3 3 0 0 1 6 0v2"/></svg>
            Mes commandes
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'informations' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=mes-informations">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M5 21c0-4 3-6 7-6s7 2 7 6"/></svg>
            Mes informations
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'deconnexion' ? 'actif' : '' ?>" href="/vitegourmand/public/index.php?p=logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4H5v16h10"/><path d="M13 12h8"/><path d="M18 9l3 3-3 3"/></svg>
            Déconnexion
        </a>
    </nav>
    <div class="sidebar-bas">
        <span class="sidebar-avatar"><?= strtoupper(substr($_SESSION['email'] ?? 'U', 0, 1)) ?></span>
        <span><?= htmlspecialchars($_SESSION['email'] ?? '') ?></span>
    </div>
</aside>
