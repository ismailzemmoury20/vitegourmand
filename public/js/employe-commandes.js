document.querySelectorAll('.ouvrir-statut').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('statut-numero-commande').value = bouton.dataset.numero;
        document.getElementById('statut-numero-affiche').textContent = bouton.dataset.numero;
        document.getElementById('statut-actuel').textContent = bouton.dataset.actuel;

        const statutCache = document.getElementById('statut-nouveau');
        if (statutCache) {
            statutCache.value = bouton.dataset.suivant;
            document.getElementById('statut-suivant').textContent = bouton.dataset.suivant;
        }

        const optionRetourMateriel = document.getElementById('option-retour-materiel');
        const optionTerminee = document.getElementById('option-terminee');

        if (optionRetourMateriel && optionTerminee) {
            const statutActuel = bouton.dataset.actuel;
            const pretMateriel = bouton.dataset.pretMateriel === '1';

            optionRetourMateriel.hidden = !(statutActuel === 'livrée' && pretMateriel);
            optionTerminee.hidden = !((statutActuel === 'livrée' && !pretMateriel) || statutActuel === 'en attente du retour de matériel');
        }
    });
});

document.querySelectorAll('.ouvrir-annulation').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('annulation-numero-commande').value = bouton.dataset.numero;
        document.getElementById('annulation-numero-affiche').textContent = bouton.dataset.numero;
    });
});
