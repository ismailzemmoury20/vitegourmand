<div class="popup-overlay" id="popup-menu-supprimer">
    <div class="popup">
        <div class="popup-entete">
            <h2>Supprimer le menu</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="supprimer">
            <input type="hidden" name="menu_id" id="suppr-menu-id">
            <div class="popup-corps">
                <p>Voulez-vous vraiment supprimer le menu <strong id="suppr-menu-titre"></strong> ?</p>
                <p class="popup-avertissement">La suppression est impossible si des commandes y sont associées.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Supprimer</button>
            </div>
        </form>
    </div>
</div>
