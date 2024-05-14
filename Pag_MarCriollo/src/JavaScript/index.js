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