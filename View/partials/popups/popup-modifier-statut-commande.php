<?php $estAdminPopup = (int) ($_SESSION['role_id'] ?? 0) === 1; ?>
<div class="popup-overlay" id="popup-statut">
    <div class="popup">
        <div class="popup-entete">
            <h2>Modifier le statut</h2>
            <button type="button" class="popup-fermer">&times;</button>
        </div>
        <form method="post" action="">
            <input type="hidden" name="action" value="modifier_statut">
            <input type="hidden" name="numero_commande" id="statut-numero-commande">
            <div class="popup-corps">
                <?php if ($estAdminPopup): ?>
                    <p>Commande <strong id="statut-numero-affiche"></strong> — statut actuel : <strong id="statut-actuel"></strong></p>
                    <label for="statut-nouveau-select">Nouveau statut</label>
                    <select id="statut-nouveau-select" name="statut" required>
                        <option value="">Choisir un statut</option>
                        <option value="en attente">En attente</option>
                        <option value="en préparation">En préparation</option>
                        <option value="prête">Prête</option>
                        <option value="livrée">Livrée</option>
                        <option value="en attente du retour de matériel" id="option-retour-materiel" hidden>En attente du retour de matériel</option>
                        <option value="terminée" id="option-terminee" hidden>Terminée</option>
                    </select>
                <?php else: ?>
                    <input type="hidden" name="statut" id="statut-nouveau">
                    <p>Passer la commande <strong id="statut-numero-affiche"></strong> de <strong id="statut-actuel"></strong> à <strong id="statut-suivant"></strong> ?</p>
                <?php endif; ?>
                <p class="popup-avertissement">Le changement sera enregistré dans l'historique de la commande.</p>
            </div>
            <div class="popup-pied">
                <button type="button" class="bouton bouton-petit bouton-annuler popup-retour">Retour</button>
                <button type="submit" class="bouton bouton-petit">Confirmer</button>
            </div>
        </form>
    </div>
</div>
