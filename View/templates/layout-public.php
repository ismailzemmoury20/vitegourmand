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
    <?php if (!empty($style)): ?>
        <link rel="stylesheet" href="/vitegourmand/public/css/<?= $style ?>?v=<?= filemtime(__DIR__ . '/../../public/css/' . $style) ?>">
    <?php endif; ?>
</head>
<body>
    <?php require __DIR__ . '/../partials/header.php'; ?>
    <main>
        <?= $contenu ?>
    </main>
    <?php require __DIR__ . '/../partials/footer.php'; ?>
    <script src="/vitegourmand/public/js/popups.js?v=<?= filemtime(__DIR__ . '/../../public/js/popups.js') ?>"></script>
    <script src="/vitegourmand/public/js/header.js?v=<?= filemtime(__DIR__ . '/../../public/js/header.js') ?>"></script>
    <?php if (!empty($script)): ?>
        <script src="/vitegourmand/public/js/<?= $script ?>?v=<?= filemtime(__DIR__ . '/../../public/js/' . $script) ?>"></script>
    <?php endif; ?>
</body>
</html>
