<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?? 'Vite & Gourmand' ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/vitegourmand/public/css/style.css?v=<?= filemtime(__DIR__ . '/../../public/css/style.css') ?>">
    <link rel="stylesheet" href="/vitegourmand/public/css/espace.css?v=<?= filemtime(__DIR__ . '/../../public/css/espace.css') ?>">
    <?php if (!empty($style)): ?>
        <link rel="stylesheet" href="/vitegourmand/public/css/<?= $style ?>?v=<?= filemtime(__DIR__ . '/../../public/css/' . $style) ?>">
    <?php endif; ?>
</head>
<body class="corps-espace">
    <div class="mobile-topbar">
        <a class="logo" href="/vitegourmand/public/index.php?p=home">Vite &amp; Gourmand</a>
        <button type="button" class="menu-toggle" id="menu-toggle" aria-label="Ouvrir le menu">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
        </button>
    </div>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <?php require __DIR__ . '/../partials/sidebar-admin.php'; ?>
    <main class="espace-contenu">
        <?= $contenu ?>
    </main>
    <script src="/vitegourmand/public/js/popups.js?v=<?= filemtime(__DIR__ . '/../../public/js/popups.js') ?>"></script>
    <script src="/vitegourmand/public/js/espace.js?v=<?= filemtime(__DIR__ . '/../../public/js/espace.js') ?>"></script>
    <?php if (!empty($script)): ?>
        <script src="/vitegourmand/public/js/<?= $script ?>?v=<?= filemtime(__DIR__ . '/../../public/js/' . $script) ?>"></script>
    <?php endif; ?>
</body>
</html>
