const modifFerme = document.getElementById('modif-ferme');
const modifOuverture = document.getElementById('modif-heure-ouverture');
const modifFermeture = document.getElementById('modif-heure-fermeture');

function appliquerEtatFerme(ferme) {
    modifFerme.checked = ferme;
    modifOuverture.disabled = ferme;
    modifFermeture.disabled = ferme;
    modifOuverture.required = !ferme;
    modifFermeture.required = !ferme;

    if (ferme) {
        modifOuverture.value = '';
        modifFermeture.value = '';
    }
}

document.querySelectorAll('.ouvrir-horaire-modifier').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('modif-horaire-id').value = bouton.dataset.id;
        document.getElementById('modif-horaire-jour').textContent = bouton.dataset.jour;

        const estFerme = bouton.dataset.ouverture.toLowerCase() === 'fermé';
        appliquerEtatFerme(estFerme);

        if (!estFerme) {
            modifOuverture.value = bouton.dataset.ouverture;
            modifFermeture.value = bouton.dataset.fermeture;
        }
    });
});

modifFerme.addEventListener('change', function () {
    appliquerEtatFerme(modifFerme.checked);
});
