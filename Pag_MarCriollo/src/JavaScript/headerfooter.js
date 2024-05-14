
const menuDesplegable = document.getElementById('menu-desplegable');
const opciones = document.querySelector('.opciones');
menuDesplegable.addEventListener('click', function() {
    opciones.classList.toggle('open');
});