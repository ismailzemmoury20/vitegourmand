<?php
$horaires = \App\App::getInstance()->getTable('horaire')->findAll();
$groupes = [];
$groupeActuel = null;

foreach ($horaires as $horaire) {
    $cle = $horaire['heure_ouverture'] . '|' . $horaire['heure_fermeture'];

    if ($groupeActuel && $groupeActuel['cle'] === $cle) {
        $groupeActuel['dernierJour'] = $horaire['jour'];
    } else {
        if ($groupeActuel) {
            $groupes[] = $groupeActuel;
        }
        $groupeActuel = [
            'cle'           => $cle,
            'premierJour'   => $horaire['jour'],
            'dernierJour'   => $horaire['jour'],
            'ouverture'     => $horaire['heure_ouverture'],
            'fermeture'     => $horaire['heure_fermeture'],
        ];
    }
}
if ($groupeActuel) {
    $groupes[] = $groupeActuel;
}
?>
<footer class="pied">
    <p class="pied-logo">Vite &amp; Gourmand</p>
    <div class="pied-horaires">
        <p class="pied-horaires-titre">Horaires d'ouverture :</p>
        <?php foreach ($groupes as $groupe): ?>
            <p>
                <?= htmlspecialchars($groupe['premierJour']) ?><?= $groupe['premierJour'] !== $groupe['dernierJour'] ? ' - ' . htmlspecialchars($groupe['dernierJour']) : '' ?> :
                <?php if (strtolower($groupe['ouverture']) === 'fermé'): ?>
                    Fermé
                <?php else: ?>
                    <?= htmlspecialchars(str_replace(':', 'h', $groupe['ouverture'])) ?> - <?= htmlspecialchars(str_replace(':', 'h', $groupe['fermeture'])) ?>
                <?php endif; ?>
            </p>
        <?php endforeach; ?>
    </div>
    <a class="pied-lien" href="/vitegourmand/public/index.php?p=mentions-legales">Mentions légales</a>
</footer>
