<div class="popup-overlay" id="popup-horaire-modifier">
    <div class="popup">
        <div class="popup-entete">
            <h2>Modifier les horaires</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="horaire_id" id="modif-horaire-id">
            <div class="popup-corps">
                <p>Horaires du <strong id="modif-horaire-jour"></strong></p>
                <label class="popup-case">
                    <input type="checkbox" id="modif-ferme" name="ferme">
                    Fermé ce jour
                </label>
                <div id="modif-horaires-champs">
                    <label for="modif-heure-ouverture">Heure d'ouverture</label>
                    <input type="time" id="modif-heure-ouverture" name="heure_ouverture">
                    <label for="modif-heure-fermeture">Heure de fermeture</label>
                    <input type="time" id="modif-heure-fermeture" name="heure_fermeture">
                </div>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
