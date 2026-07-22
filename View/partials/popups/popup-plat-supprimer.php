<div class="popup-overlay" id="popup-plat-supprimer">
    <div class="popup">
        <div class="popup-entete">
            <h2>Supprimer le plat</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="supprimer">
            <input type="hidden" name="plat_id" id="suppr-plat-id">
            <div class="popup-corps">
                <p>Voulez-vous vraiment supprimer le plat <strong id="suppr-plat-titre"></strong> ?</p>
                <p class="popup-avertissement">Cette action est définitive.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Supprimer</button>
            </div>
        </form>
    </div>
</div>
