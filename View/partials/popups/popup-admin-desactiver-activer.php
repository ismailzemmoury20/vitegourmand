<div class="popup-overlay" id="popup-admin-desactiver-activer">
    <div class="popup">
        <div class="popup-entete">
            <h2 id="actif-admin-titre">Désactiver le compte</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" id="actif-admin-action">
            <input type="hidden" name="utilisateur_id" id="actif-admin-id">
            <div class="popup-corps">
                <p><span id="actif-admin-question"></span> le compte administrateur de <strong id="actif-admin-nom"></strong> ?</p>
                <p class="popup-avertissement">Le dernier administrateur actif ne peut pas être désactivé.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Confirmer</button>
            </div>
        </form>
    </div>
</div>
