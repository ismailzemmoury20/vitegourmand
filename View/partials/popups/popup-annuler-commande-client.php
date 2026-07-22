<div class="popup-overlay" id="popup-annuler">
    <div class="popup">
        <div class="popup-entete">
            <h2>Annuler la commande</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <div class="popup-corps">
            <div id="popup-annuler-confirmation">
                <p>Voulez-vous vraiment annuler la commande <strong class="popup-annuler-numero"></strong> ?</p>
                <p class="popup-avertissement">Cette action est définitive.</p>
            </div>
            <div id="popup-annuler-refus">
                <p>La commande <strong class="popup-annuler-numero"></strong> ne peut pas être annulée car elle est <strong id="popup-refus-statut"></strong>.</p>
                <p class="popup-avertissement">Seule une commande en attente peut être annulée.</p>
            </div>
        </div>
        <div class="popup-pied">
            <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Non, retour</button>
            <a class="bouton bouton-petit" id="popup-annuler-confirmer" href="#">Oui, annuler</a>
        </div>
    </div>
</div>
