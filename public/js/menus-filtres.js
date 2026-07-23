const prixFourchette = document.getElementById('prix-fourchette');
const fourchetteValeur = document.getElementById('fourchette-valeur');
const filtreForm = document.getElementById('filtre-form');
const listeMenus = document.getElementById('liste-menus');

if (prixFourchette && fourchetteValeur) {
    prixFourchette.addEventListener('input', function () {
        fourchetteValeur.textContent = prixFourchette.value + ' €';
    });
}

function chargerMenus() {
    const params = new URLSearchParams();
    params.set('p', 'menus-filtrer');
    params.set('action', 'filtrer');
    params.set('prix_max', document.getElementById('prix-max').value);
    params.set('prix_fourchette', prixFourchette.value);
    params.set('regime', document.getElementById('regime').value);
    params.set('theme', document.getElementById('theme').value);

    fetch('/index.php?' + params.toString())
        .then(function (reponse) {
            return reponse.text();
        })
        .then(function (html) {
            listeMenus.innerHTML = html;
        });
}

if (filtreForm && listeMenus) {
    filtreForm.addEventListener('submit', function (evenement) {
        evenement.preventDefault();
        chargerMenus();
    });

    ['prix-max', 'prix-fourchette', 'regime', 'theme'].forEach(function (id) {
        document.getElementById(id).addEventListener('change', chargerMenus);
    });
}

function afficherDetailMenu(menuId) {
    fetch('/index.php?p=menus&action=getMenuDetails&id=' + menuId)
        .then(function (reponse) {
            return reponse.json();
        })
        .then(function (menu) {
            document.getElementById('detail-menu-titre').textContent = menu.titre;
            document.getElementById('detail-menu-description').textContent = menu.description;
            document.getElementById('detail-menu-minimum').textContent = menu.nombre_personne_minimum;
            document.getElementById('detail-menu-prix').textContent = menu.prix_par_personne;
            document.getElementById('detail-menu-conditions').textContent = menu.conditions || '';
            document.getElementById('detail-menu-stock').textContent = menu.quantite_restante + ' disponible(s) en stock';
            document.getElementById('detail-menu-commander').href = '/index.php?p=commande&menu_id=' + menu.menu_id;

            const galerie = document.getElementById('detail-menu-galerie');
            galerie.innerHTML = '';
            menu.photos.forEach(function (photoBase64) {
                const img = document.createElement('img');
                img.src = 'data:image/jpeg;base64,' + photoBase64;
                img.alt = menu.titre;
                galerie.appendChild(img);
            });

            const badges = document.getElementById('detail-menu-badges');
            badges.innerHTML = '';
            menu.themes.concat(menu.regimes).forEach(function (libelle) {
                const badge = document.createElement('span');
                badge.className = 'badge';
                badge.textContent = libelle;
                badges.appendChild(badge);
            });

            const listePlats = document.getElementById('detail-menu-plats');
            listePlats.innerHTML = '';
            if (menu.plats.length === 0) {
                const li = document.createElement('li');
                li.textContent = 'Aucun plat renseigné pour ce menu.';
                listePlats.appendChild(li);
            } else {
                menu.plats.forEach(function (titrePlat) {
                    const li = document.createElement('li');
                    li.textContent = titrePlat;
                    listePlats.appendChild(li);
                });
            }

            document.getElementById('popup-menu-detail').classList.add('ouvert');
        });
}

if (listeMenus) {
    listeMenus.addEventListener('click', function (evenement) {
        const bouton = evenement.target.closest('.voir-detail');
        if (bouton) {
            afficherDetailMenu(bouton.dataset.id);
        }
    });
}
