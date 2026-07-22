<div class="popup-overlay" id="popup-employe-ajouter">
    <div class="popup">
        <div class="popup-entete">
            <h2>Créer un compte employé</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="creer">
            <div class="popup-corps">
                <label for="ajout-employe-nom">Nom</label>
                <input type="text" id="ajout-employe-nom" name="nom" required>
                <label for="ajout-employe-prenom">Prénom</label>
                <input type="text" id="ajout-employe-prenom" name="prenom" required>
                <label for="ajout-employe-email">Email</label>
                <input type="email" id="ajout-employe-email" name="email" required>
                <label for="ajout-employe-mpd">Mot de passe</label>
                <input type="password" id="ajout-employe-mpd" name="mpd" minlength="8" required>
                <p class="popup-avertissement">Ce mot de passe ne sera pas envoyé par email. L'employé devra se rapprocher de vous pour l'obtenir.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Créer le compte</button>
            </div>
        </form>
    </div>
</div>
