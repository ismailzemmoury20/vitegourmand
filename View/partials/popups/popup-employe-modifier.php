<div class="popup-overlay" id="popup-employe-modifier">
    <div class="popup">
        <div class="popup-entete">
            <h2>Modifier l'employé</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="utilisateur_id" id="modif-employe-id">
            <div class="popup-corps">
                <label for="modif-employe-nom">Nom</label>
                <input type="text" id="modif-employe-nom" name="nom" required>
                <label for="modif-employe-prenom">Prénom</label>
                <input type="text" id="modif-employe-prenom" name="prenom" required>
                <label for="modif-employe-email">Email</label>
                <input type="email" id="modif-employe-email" name="email" required>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
