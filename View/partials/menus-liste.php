<?php if (empty($menus)): ?>
    <p class="menus-vide">Aucun menu ne correspond à votre recherche.</p>
<?php else: ?>
    <?php foreach ($menus as $menu): ?>
        <div class="menu-item-1">
            <div class="menu-content">
                <?php if (!empty($menu['photo'])): ?>
                    <img src="data:image/jpeg;base64,<?= base64_encode($menu['photo']) ?>" alt="<?= htmlspecialchars($menu['titre']) ?>">
                <?php endif; ?>
                <h3><?= htmlspecialchars($menu['titre']) ?></h3>
                <p class="menu-description"><?= htmlspecialchars($menu['description'] ?? '') ?></p>
                <p class="menu-info">MINIMUM <?= (int) ($menu['nombre_personne_minimum'] ?? 0) ?> PERSONNES</p>
                <p class="price"><?= (float) $menu['prix_par_personne'] ?> €</p>
                <div class="menu-content-boutons">
                    <button type="button" class="voir-detail" data-id="<?= (int) $menu['menu_id'] ?>">Voir le détail</button>
                    <a href="/vitegourmand/public/index.php?p=commande&menu_id=<?= (int) $menu['menu_id'] ?>">
                        <button>Commander</button>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
