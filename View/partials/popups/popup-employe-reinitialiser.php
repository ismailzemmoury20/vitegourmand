<div class="popup-overlay" id="popup-employe-reinitialiser">
    <div class="popup">
        <div class="popup-entete">
            <h2>Réinitialiser le mot de passe</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="reinitialiser">
            <input type="hidden" name="utilisateur_id" id="reinit-employe-id">
            <div class="popup-corps">
                <p>Réinitialiser le mot de passe de <strong id="reinit-employe-nom"></strong> ?</p>
                <p class="popup-avertissement">Un nouveau mot de passe temporaire sera généré et envoyé par email. L'employé devra le changer à sa prochaine connexion.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Réinitialiser</button>
            </div>
        </form>
    </div>
</div>
