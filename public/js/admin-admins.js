document.querySelectorAll('.ouvrir-admin-actif').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        const desactiver = bouton.dataset.action === 'desactiver';
        document.getElementById('actif-admin-id').value = bouton.dataset.id;
        document.getElementById('actif-admin-action').value = bouton.dataset.action;
        document.getElementById('actif-admin-nom').textContent = bouton.dataset.nom;
        document.getElementById('actif-admin-titre').textContent = desactiver ? 'Désactiver le compte' : 'Activer le compte';
        document.getElementById('actif-admin-question').textContent = desactiver ? 'Désactiver' : 'Activer';
    });
});
