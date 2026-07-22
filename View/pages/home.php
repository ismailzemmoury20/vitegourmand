<?php
$titre = $pageTitle . ' - Vite & Gourmand';
$style = 'home.css';

ob_start();
?>

<section class="presentation-section">
    <div class="presentation-texte">
        <h1>Vite &amp; Gourmand</h1>
        <p>Fondée par Julie et José, Vite &amp; Gourmand est une entreprise de traiteur événementiel installée à Bordeaux depuis 25 ans. Nous accompagnons tous vos événements, des repas simples entre proches aux grandes occasions comme Noël ou Pâques.</p>
        <p>Notre menu est en constante évolution afin de vous proposer des créations toujours renouvelées, adaptées à chaque occasion.</p>
    </div>
    <div class="presentation-image">
        <img src="/vitegourmand/Image/vitegourmand.jpg" alt="Plats préparés par Vite & Gourmand pour un événement">
    </div>
</section>

<section class="equipe-section">
    <div class="equipe-image">
        <img src="/vitegourmand/Image/teamrestaurant.jpg" alt="L'équipe de Vite & Gourmand au travail en cuisine">
    </div>
    <div class="equipe-texte">
        <h2>Une équipe de professionnels</h2>
        <p>Julie, José et toute leur équipe mettent leur savoir-faire et leur passion au service de vos événements. Rigueur, créativité et sens du détail : chaque plat est préparé avec le même soin, pour que votre réception reste un moment inoubliable.</p>
    </div>
</section>

<section class="avis-section">
    <h2>Les avis de nos clients</h2>
    <?php if (empty($avis)): ?>
        <p class="avis-vide">Aucun avis pour le moment</p>
    <?php else: ?>
        <div class="avis-list">
            <?php foreach ($avis as $unAvis): ?>
                <article class="avis-card">
                    <h3 class="avis-nom"><?= htmlspecialchars($unAvis['nom']) ?></h3>
                    <p class="avis-note">
                        <?= str_repeat('★', (int) $unAvis['note']) . str_repeat('☆', 5 - (int) $unAvis['note']) ?>
                        <span class="avis-note-chiffre"><?= htmlspecialchars((string) $unAvis['note']) ?>/5</span>
                    </p>
                    <p class="avis-description"><?= htmlspecialchars($unAvis['description']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../templates/layout-public.php';
