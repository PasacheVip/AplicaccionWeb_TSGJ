document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.nav-link a');
    const contentDiv = document.getElementById('content');

    menuLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const page = this.getAttribute('data-page');
            loadPage(page);
        });
    });

    function loadPage(page) {
        fetch(page)
            .then(response => response.text())
            .then(data => {
                contentDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error loading page:', error);
                contentDiv.innerHTML = '<p>Error loading page. Please try again later.</p>';
            });
    }

    // Cargar la página inicial
    loadPage('../../../Vista/General/Adm_Menu_Navegacion.php');
});
