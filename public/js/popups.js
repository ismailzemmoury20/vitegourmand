document.querySelectorAll('[data-popup]').forEach(function (bouton) {
    bouton.addEventListener('click', function (evenement) {
        evenement.preventDefault();
        document.getElementById(bouton.dataset.popup).classList.add('ouvert');
    });
});

document.querySelectorAll('.popup-overlay').forEach(function (overlay) {
    overlay.querySelectorAll('.popup-fermer, .popup-retour').forEach(function (bouton) {
        bouton.addEventListener('click', function () {
            overlay.classList.remove('ouvert');
        });
    });

    overlay.addEventListener('click', function (evenement) {
        if (evenement.target === overlay) {
            overlay.classList.remove('ouvert');
        }
    });
});
