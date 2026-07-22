document.querySelectorAll('.ouvrir-plat-modifier').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('modif-plat-id').value = bouton.dataset.id;
        document.getElementById('modif-titre').value = bouton.dataset.titre;
    });
});

document.querySelectorAll('.ouvrir-plat-supprimer').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('suppr-plat-id').value = bouton.dataset.id;
        document.getElementById('suppr-plat-titre').textContent = bouton.dataset.titre;
    });
});
