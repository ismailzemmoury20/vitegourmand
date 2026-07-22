const menuToggle = document.getElementById('menu-toggle');
const enteteNav = document.getElementById('entete-nav');
const sidebarOverlay = document.getElementById('sidebar-overlay');

if (menuToggle && enteteNav && sidebarOverlay) {
    function fermerMenu() {
        enteteNav.classList.remove('ouvert');
        sidebarOverlay.classList.remove('ouvert');
    }

    menuToggle.addEventListener('click', function () {
        enteteNav.classList.toggle('ouvert');
        sidebarOverlay.classList.toggle('ouvert');
    });

    sidebarOverlay.addEventListener('click', fermerMenu);

    enteteNav.querySelectorAll('a').forEach(function (lien) {
        lien.addEventListener('click', fermerMenu);
    });
}
