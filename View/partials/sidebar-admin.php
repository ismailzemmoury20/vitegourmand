<aside class="sidebar">
    <a class="logo" href="/index.php?p=home">Vite &amp; Gourmand</a>
    <nav class="sidebar-nav">
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'dashboard' ? 'actif' : '' ?>" href="/index.php?p=admin-dashboard">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 13h6V4H4v9z"/><path d="M14 20h6v-9h-6v9z"/><path d="M4 20h6v-4H4v4z"/><path d="M14 8h6V4h-6v4z"/></svg>
            Tableau de bord
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'employes' ? 'actif' : '' ?>" href="/index.php?p=admin-employes">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="4"/><path d="M2 21c0-4 3-6 7-6s7 2 7 6"/><path d="M17 8a3 3 0 0 1 0 6"/><path d="M19 15c2 .8 3 2.5 3 6"/></svg>
            Employés
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'admins' ? 'actif' : '' ?>" href="/index.php?p=admin-admins">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M5 21c0-4 3-6 7-6s7 2 7 6"/><path d="M12 2v2"/></svg>
            Administrateurs
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'clients' ? 'actif' : '' ?>" href="/index.php?p=admin-clients">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M5 21c0-4 3-6 7-6s7 2 7 6"/></svg>
            Clients
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'commandes' ? 'actif' : '' ?>" href="/index.php?p=employe-commandes">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 7h12l1 14H5L6 7z"/><path d="M9 7V5a3 3 0 0 1 6 0v2"/></svg>
            Commandes
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'menus' ? 'actif' : '' ?>" href="/index.php?p=admin-menus">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16v16H4z"/><path d="M8 8h8"/><path d="M8 12h8"/><path d="M8 16h5"/></svg>
            Menus
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'plats' ? 'actif' : '' ?>" href="/index.php?p=employe-plats">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4"/></svg>
            Plats
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'horaires' ? 'actif' : '' ?>" href="/index.php?p=employe-horaires">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
            Horaires
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'avis' ? 'actif' : '' ?>" href="/index.php?p=employe-avis-clients">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l2.7 5.5 6.3.9-4.5 4.4 1 6.2-5.5-2.9-5.5 2.9 1-6.2L3 9.4l6.3-.9L12 3z"/></svg>
            Avis clients
        </a>
        <a class="sidebar-lien <?= ($pageActive ?? '') === 'deconnexion' ? 'actif' : '' ?>" href="/index.php?p=logout">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 4H5v16h10"/><path d="M13 12h8"/><path d="M18 9l3 3-3 3"/></svg>
            Déconnexion
        </a>
    </nav>
    <div class="sidebar-bas">
        <span class="sidebar-avatar"><?= strtoupper(substr($_SESSION['email'] ?? 'A', 0, 1)) ?></span>
        <span><?= htmlspecialchars($_SESSION['email'] ?? '') ?></span>
    </div>
</aside>
