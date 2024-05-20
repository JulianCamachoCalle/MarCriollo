// Abrir los enlaces de las redes sociales en una nueva pestaña
document.querySelectorAll('.social-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
        window.open(this.href, '_blank'); // Abre el enlace en una nueva pestaña
    });
});

// Función para desplazarse hacia arriba de la página
function scrollToTop() {
    window.scrollTo({
        top: 0, // Desplaza hasta la parte superior de la página
        behavior: "smooth" // Desplazamiento suave
    });
}

// Mostrar u ocultar el botón de scroll arriba según la posición del usuario
window.addEventListener("scroll", function() {
    var scrollButton = document.getElementById("scrollUp"); // Obtén el botón de scroll arriba
    if (document.documentElement.scrollTop > 20) { // Si el desplazamiento vertical es mayor a 20 pixels
        scrollButton.style.display = "block"; // Muestra el botón de scroll arriba
    } else {
        scrollButton.style.display = "none"; // Oculta el botón de scroll arriba
    }
});
