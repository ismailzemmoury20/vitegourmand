<div class="popup-overlay" id="popup-plat-ajouter">
    <div class="popup">
        <div class="popup-entete">
            <h2>Ajouter un plat</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="ajouter">
            <div class="popup-corps">
                <label for="ajout-titre">Titre du plat</label>
                <input type="text" id="ajout-titre" name="titre" required>
                <label for="ajout-photo">Photo</label>
                <input type="file" id="ajout-photo" name="avatar" accept=".jpg,.jpeg,.png,.webp" required>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Ajouter</button>
            </div>
        </form>
    </div>
</div>
