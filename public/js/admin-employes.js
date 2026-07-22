document.querySelectorAll('.ouvrir-employe-modifier').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('modif-employe-id').value = bouton.dataset.id;
        document.getElementById('modif-employe-nom').value = bouton.dataset.nom;
        document.getElementById('modif-employe-prenom').value = bouton.dataset.prenom;
        document.getElementById('modif-employe-email').value = bouton.dataset.email;
    });
});

document.querySelectorAll('.ouvrir-employe-reinitialiser').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        document.getElementById('reinit-employe-id').value = bouton.dataset.id;
        document.getElementById('reinit-employe-nom').textContent = bouton.dataset.nom;
    });
});

document.querySelectorAll('.ouvrir-employe-actif').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        const desactiver = bouton.dataset.action === 'desactiver';
        document.getElementById('actif-employe-id').value = bouton.dataset.id;
        document.getElementById('actif-employe-action').value = bouton.dataset.action;
        document.getElementById('actif-employe-nom').textContent = bouton.dataset.nom;
        document.getElementById('actif-employe-titre').textContent = desactiver ? 'Désactiver le compte' : 'Activer le compte';
        document.getElementById('actif-employe-question').textContent = desactiver ? 'Désactiver' : 'Activer';
    });
});
