<div class="popup-overlay" id="popup-admin-ajouter">
    <div class="popup">
        <div class="popup-entete">
            <h2>Créer un administrateur</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="creer">
            <div class="popup-corps">
                <label for="ajout-admin-nom">Nom</label>
                <input type="text" id="ajout-admin-nom" name="nom" required>
                <label for="ajout-admin-prenom">Prénom</label>
                <input type="text" id="ajout-admin-prenom" name="prenom" required>
                <label for="ajout-admin-email">Email</label>
                <input type="email" id="ajout-admin-email" name="email" required>
                <p class="popup-avertissement">Un mot de passe temporaire sera généré et envoyé par email. Il devra être changé à la première connexion.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Créer le compte</button>
            </div>
        </form>
    </div>
</div>
