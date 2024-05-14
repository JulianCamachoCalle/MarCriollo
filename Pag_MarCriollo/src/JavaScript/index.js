//Cambiar fondo
const mainElement = document.getElementById('main');
const backgrounds = ['fondo1.jpg', 'fondo2.jpeg', 'fondo3.jpg'];
let currentIndex = 0;

function cambiarFondo() {
    mainElement.style.backgroundImage = `url('../img/${backgrounds[currentIndex]}')`;
    currentIndex = (currentIndex + 1) % backgrounds.length;
}

setInterval(cambiarFondo, 5000);
