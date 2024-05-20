/*Cambiar fondo
const mainElement = document.getElementById('main');
const backgrounds = ['fondo1', 'fondo2', 'fondo3'];
let currentIndex = 0;

function cambiarFondo() {
    mainElement.className = `main ${backgrounds[currentIndex]}`;
    currentIndex = (currentIndex + 1) % backgrounds.length;
}

setInterval(cambiarFondo, 5000);*/

//PLATOS
const carrusel = document.querySelector('.carrusel');
const platos = document.querySelectorAll('.plato');
let currentIndex = 0;

function mostrarPlato(index) {
    platos.forEach(plato => {
        plato.style.display = 'none';
    });
    platos[index].style.display = 'block';
}

function cambiarPlato(direccion) {
    if (direccion === 'siguiente') {
        currentIndex = (currentIndex + 1) % platos.length;
    } else if (direccion === 'anterior') {
        currentIndex = (currentIndex - 1 + platos.length) % platos.length;
    }
    mostrarPlato(currentIndex);
}

mostrarPlato(currentIndex); 

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