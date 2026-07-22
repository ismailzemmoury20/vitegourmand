<div class="popup-overlay" id="popup-menu-modifier">
    <div class="popup">
        <div class="popup-entete">
            <h2>Modifier le menu</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="menu_id" id="modif-menu-id">
            <div class="popup-corps">
                <label for="modif-menu-titre">Titre du menu</label>
                <input type="text" id="modif-menu-titre" name="titre" required>
                <label for="modif-menu-prix">Prix par personne (€)</label>
                <input type="number" id="modif-menu-prix" name="prix" min="0" step="0.01" required>
                <label for="modif-menu-stock">Quantité restante</label>
                <input type="number" id="modif-menu-stock" name="stock" min="0" required>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
