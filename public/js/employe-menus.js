document.querySelectorAll('.ouvrir-menu-modifier').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('modif-menu-id').value = bouton.dataset.id;
        document.getElementById('modif-menu-titre').value = bouton.dataset.titre;
        document.getElementById('modif-menu-prix').value = bouton.dataset.prix;
        document.getElementById('modif-menu-stock').value = bouton.dataset.stock;
    });
});

document.querySelectorAll('.ouvrir-menu-supprimer').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('suppr-menu-id').value = bouton.dataset.id;
        document.getElementById('suppr-menu-titre').textContent = bouton.dataset.titre;
    });
});
