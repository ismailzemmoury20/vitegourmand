<div class="popup-overlay" id="popup-employe-desactiver-activer">
    <div class="popup">
        <div class="popup-entete">
            <h2 id="actif-employe-titre">Désactiver le compte</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" id="actif-employe-action">
            <input type="hidden" name="utilisateur_id" id="actif-employe-id">
            <div class="popup-corps">
                <p><span id="actif-employe-question"></span> le compte de <strong id="actif-employe-nom"></strong> ?</p>
                <p class="popup-avertissement">Un compte désactivé ne peut plus se connecter, mais reste visible dans l'historique.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Confirmer</button>
            </div>
        </form>
    </div>
</div>
