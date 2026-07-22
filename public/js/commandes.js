const popupAnnuler = document.getElementById('popup-annuler');

if (popupAnnuler) {
    const blocConfirmation = document.getElementById('popup-annuler-confirmation');
    const blocRefus = document.getElementById('popup-annuler-refus');
    const refusStatut = document.getElementById('popup-refus-statut');
    const popupConfirmer = document.getElementById('popup-annuler-confirmer');
    const popupRetour = popupAnnuler.querySelector('.popup-retour');

    document.querySelectorAll('.ouvrir-popup-annuler').forEach(function (bouton) {
        bouton.addEventListener('click', function (evenement) {
            evenement.preventDefault();

            popupAnnuler.querySelectorAll('.popup-annuler-numero').forEach(function (numero) {
                numero.textContent = bouton.dataset.numero;
            });

            if (bouton.dataset.statut === 'en attente') {
                blocConfirmation.style.display = 'block';
                blocRefus.style.display = 'none';
                popupConfirmer.style.display = 'inline-block';
                popupConfirmer.href = bouton.dataset.url;
                popupRetour.textContent = 'Non, retour';
            } else {
                blocConfirmation.style.display = 'none';
                blocRefus.style.display = 'block';
                refusStatut.textContent = bouton.dataset.statut;
                popupConfirmer.style.display = 'none';
                popupRetour.textContent = 'Fermer';
            }

            popupAnnuler.classList.add('ouvert');
        });
    });

    function fermerPopup() {
        popupAnnuler.classList.remove('ouvert');
    }

    popupAnnuler.querySelector('.popup-fermer').addEventListener('click', fermerPopup);
    popupRetour.addEventListener('click', fermerPopup);

    popupAnnuler.addEventListener('click', function (evenement) {
        if (evenement.target === popupAnnuler) {
            fermerPopup();
        }
    });
}
