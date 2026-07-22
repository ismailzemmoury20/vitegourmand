document.querySelectorAll('.ouvrir-client-bloquer').forEach(function (bouton) {
    bouton.addEventListener('click', function () {
        const bloquer = bouton.dataset.action === 'bloquer';
        document.getElementById('bloquer-client-id').value = bouton.dataset.id;
        document.getElementById('bloquer-client-action').value = bouton.dataset.action;
        document.getElementById('bloquer-client-nom').textContent = bouton.dataset.nom;
        document.getElementById('bloquer-client-titre').textContent = bloquer ? 'Bloquer le compte' : 'Débloquer le compte';
        document.getElementById('bloquer-client-question').textContent = bloquer ? 'Bloquer' : 'Débloquer';
    });
});
