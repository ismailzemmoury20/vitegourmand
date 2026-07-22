const menuToggle = document.getElementById('menu-toggle');
const sidebar = document.querySelector('.sidebar');
const sidebarOverlay = document.getElementById('sidebar-overlay');

if (menuToggle && sidebar && sidebarOverlay) {
    function fermerMenu() {
        sidebar.classList.remove('ouvert');
        sidebarOverlay.classList.remove('ouvert');
    }

    menuToggle.addEventListener('click', function () {
        sidebar.classList.toggle('ouvert');
        sidebarOverlay.classList.toggle('ouvert');
    });

    sidebarOverlay.addEventListener('click', fermerMenu);

    document.querySelectorAll('.sidebar-lien').forEach(function (lien) {
        lien.addEventListener('click', fermerMenu);
    });
}
