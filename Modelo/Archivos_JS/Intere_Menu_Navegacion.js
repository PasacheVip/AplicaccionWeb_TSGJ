
// JavaScript para alternar clases del nav al hacer clic en el botón de expansión
document.querySelector('.toggle').addEventListener('click', function() {
    // Alternar la clase 'expand' en la barra lateral y en el contenedor de iframe
    document.querySelector('.sidebar').classList.toggle('expand');
    document.getElementById('titulo-container').classList.toggle('expand');
    document.getElementById('iframe-container').classList.toggle('expand');
});

// Seleccionar elementos del DOM
const body = document.querySelector('body'),
    sidebar = body.querySelector('.sidebar'),
    toggle = body.querySelector(".toggle");

// Agregar evento de clic al botón de expansión
toggle.addEventListener("click", () => {
    // Alternar la clase 'close' en la barra lateral
    sidebar.classList.toggle("close");
});

// Si el ancho de la página es menor a 760px, ocultar el menú al recargar la página
if (window.innerWidth < 760) {
    // Agregar clases al cuerpo y a la barra lateral para ocultarla
    body.classList.add("body");
    sidebar.classList.add("sidebar", "close");
}
