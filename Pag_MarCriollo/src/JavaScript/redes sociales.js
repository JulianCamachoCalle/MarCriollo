
// Abrir los enlaces de las redes sociales en una nueva pestaña
document.querySelectorAll('.social-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        window.open(this.href, '_blank');
    });
});
// Datos simulados de comentarios
var comentarios = [
    { nombre: "Juan", comentario: "¡La comida es deliciosa! Definitivamente volveré.", fecha: "2024-05-15" },
    { nombre: "María", comentario: "El servicio es excelente, el ambiente muy acogedor.", fecha: "2024-05-14" },
    { nombre: "Pedro", comentario: "¡Los precios son muy accesibles! Recomiendo el ceviche.", fecha: "2024-05-13" }
];

// Función para desplazarse hacia arriba de la página
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth" // Desplazamiento suave
    });
}

// Mostrar u ocultar el botón de scroll arriba según la posición del usuario
window.addEventListener("scroll", function() {
    var scrollButton = document.getElementById("scrollUp");
    if (document.documentElement.scrollTop > 20) {
        scrollButton.style.display = "block";
    } else {
        scrollButton.style.display = "none";
    }
});