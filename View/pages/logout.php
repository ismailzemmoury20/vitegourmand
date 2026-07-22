<?php
$roleId = (int) ($_SESSION['role_id'] ?? 0);

if ($roleId === 1) {
    $layout = 'layout-admin.php';
    $retour = 'admin-dashboard';
} elseif ($roleId === 3) {
    $layout = 'layout-employe.php';
    $retour = 'employe-commandes';
} else {
    $layout = 'layout-user.php';
    $retour = 'commandes';
}
ob_start();
?>
<h1 class="espace-titre">Déconnexion</h1>
<div class="infos-carte">
    <p class="logout-question">Voulez-vous vraiment vous déconnecter ?</p>
    <form method="post" action="">
        <button type="submit" class="bouton">Se déconnecter</button>
    </form>
    <p class="logout-annuler"><a href="/vitegourmand/public/index.php?p=<?= $retour ?>">Annuler</a></p>
</div>
<?php
$contenu = ob_get_clean();
$titre = 'Déconnexion - Vite & Gourmand';
$pageActive = 'deconnexion';
$style = 'logout.css';
require __DIR__ . '/../templates/' . $layout;
