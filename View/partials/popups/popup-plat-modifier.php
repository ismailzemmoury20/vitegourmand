<div class="popup-overlay" id="popup-plat-modifier">
    <div class="popup">
        <div class="popup-entete">
            <h2>Modifier le plat</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="plat_id" id="modif-plat-id">
            <div class="popup-corps">
                <label for="modif-titre">Titre du plat</label>
                <input type="text" id="modif-titre" name="titre" required>
                <label for="modif-photo">Nouvelle photo (laisser vide pour ne pas changer)</label>
                <input type="file" id="modif-photo" name="avatar" accept=".jpg,.jpeg,.png,.webp">
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
