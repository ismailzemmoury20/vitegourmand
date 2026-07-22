const commandeForm = document.getElementById('commande-form');

if (commandeForm) {
    const prixUnitaire = parseFloat(commandeForm.dataset.prix);
    const minimum = parseInt(commandeForm.dataset.minimum);
    const champDistance = document.getElementById('champ-distance');

    function formaterPrix(valeur) {
        return valeur.toFixed(2).replace('.', ',') + ' €';
    }

    function calculerPrix() {
        const personnes = parseInt(commandeForm.number.value) || 0;
        const codePostale = commandeForm.code_postale.value;
        const ville = commandeForm.ville.value.toLowerCase();
        const distance = parseFloat(commandeForm.distance.value) || 0;

        const prixBase = personnes * prixUnitaire;
        const reduction = personnes >= minimum + 5 ? prixBase * 0.1 : 0;

        const surBordeaux = codePostale.substring(0, 2) === '33' && ville.includes('bordeaux');

        let fraisLivraison = 0;
        if (surBordeaux) {
            champDistance.style.display = 'none';
        } else {
            champDistance.style.display = 'block';
            fraisLivraison = 5 + distance * 0.59;
        }

        const total = prixBase - reduction + fraisLivraison;

        document.getElementById('prix-base').textContent = formaterPrix(prixBase);
        document.getElementById('reduction').textContent = '- ' + formaterPrix(reduction);
        document.getElementById('frais-livraison').textContent = formaterPrix(fraisLivraison);
        document.getElementById('total').textContent = formaterPrix(total);
    }

    commandeForm.addEventListener('input', calculerPrix);
    calculerPrix();
}
