<div class="popup-overlay" id="popup-annuler-employe">
    <div class="popup">
        <div class="popup-entete">
            <h2>Annuler la commande</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="annuler">
            <input type="hidden" name="numero_commande" id="annulation-numero-commande">
            <div class="popup-corps">
                <p>Annulation de la commande <strong id="annulation-numero-affiche"></strong>.</p>
                <label for="mode_contact">Mode de contact du client</label>
                <select id="mode_contact" name="mode_contact" required>
                    <option value="">Choisir un mode de contact</option>
                    <option value="téléphone">Téléphone</option>
                    <option value="email">Email</option>
                </select>
                <label for="motif">Motif de l'annulation</label>
                <textarea id="motif" name="motif" rows="4" required></textarea>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Annuler la commande</button>
            </div>
        </form>
    </div>
</div>
