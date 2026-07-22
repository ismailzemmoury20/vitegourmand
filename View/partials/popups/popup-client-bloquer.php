<div class="popup-overlay" id="popup-client-bloquer">
    <div class="popup">
        <div class="popup-entete">
            <h2 id="bloquer-client-titre">Bloquer le compte</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" id="bloquer-client-action">
            <input type="hidden" name="utilisateur_id" id="bloquer-client-id">
            <div class="popup-corps">
                <p><span id="bloquer-client-question"></span> le compte de <strong id="bloquer-client-nom"></strong> ?</p>
                <p class="popup-avertissement">Un client bloqué ne peut plus se connecter ni commander, mais son historique reste consultable.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Confirmer</button>
            </div>
        </form>
    </div>
</div>
