<?php ob_start(); ?>
<h1 class="espace-titre">Suivi de commande</h1>
<div class="suivi-conteneur">
    <div class="infos-carte suivi-carte">
        <h2 class="suivi-sous-titre">Détails de la commande</h2>
        <p class="suivi-ligne"><span>Numéro</span><span><?= htmlspecialchars($commande['numero_commande']) ?></span></p>
        <p class="suivi-ligne"><span>Menu</span><span><?= htmlspecialchars($commande['titre']) ?></span></p>
        <p class="suivi-ligne"><span>Date de la prestation</span><span><?= date('d/m/Y', strtotime($commande['date_prestation'])) ?></span></p>
        <p class="suivi-ligne"><span>Heure de livraison</span><span><?= htmlspecialchars($commande['heure_livraison']) ?></span></p>
        <p class="suivi-ligne"><span>Nombre de personnes</span><span><?= (int) $commande['nombre_personne'] ?></span></p>
        <p class="suivi-ligne"><span>Prix du menu</span><span><?= number_format((float) $commande['prix_menu'], 2, ',', ' ') ?> €</span></p>
        <p class="suivi-ligne"><span>Frais de livraison</span><span><?= number_format((float) $commande['prix_livraison'], 2, ',', ' ') ?> €</span></p>
        <p class="suivi-ligne suivi-total"><span>Total</span><span><?= number_format((float) $commande['prix_menu'] + (float) $commande['prix_livraison'], 2, ',', ' ') ?> €</span></p>
        <p class="suivi-ligne"><span>Statut actuel</span><span class="suivi-statut"><?= htmlspecialchars($commande['statut']) ?></span></p>
    </div>
    <div class="infos-carte suivi-carte">
        <h2 class="suivi-sous-titre">Historique de la commande</h2>
        <ul class="suivi-timeline">
            <?php foreach ($historique as $etape): ?>
                <li>
                    <span class="timeline-point"></span>
                    <div>
                        <p class="timeline-statut"><?= htmlspecialchars($etape['statut']) ?></p>
                        <p class="timeline-date"><?= date('d/m/Y à H:i', strtotime($etape['date_modification'])) ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<p class="suivi-retour"><a href="/vitegourmand/public/index.php?p=commandes">Retour à mes commandes</a></p>
<?php
$contenu = ob_get_clean();
$titre = 'Suivi de commande - Vite & Gourmand';
$pageActive = 'commandes';
$style = 'suivi-commande.css';
require __DIR__ . '/../../templates/layout-user.php';
