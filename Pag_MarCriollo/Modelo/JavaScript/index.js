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





                                                              // Buscador de contenido

// Ejecutando funciones al hacer clic en los elementos
document.getElementById("icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("cover-ctn-search").addEventListener("click", ocultar_buscador);

// Declarando variables
bars_search = document.getElementById("ctn-bars-search"); // Contenedor de la barra de búsqueda
cover_ctn_search = document.getElementById("cover-ctn-search"); // Cubierta de búsqueda (fondo oscuro)
inputSearch = document.getElementById("inputSearch"); // Campo de entrada de búsqueda
box_search = document.getElementById("box-search"); // Contenedor de resultados de búsqueda

// Función para mostrar el buscador
function mostrar_buscador(){
    // Muestra la barra de búsqueda
    bars_search.style.top = "80px";
    bars_search.style.display = "block";
    inputSearch.focus(); // Enfoca el campo de entrada de búsqueda

    // Oculta el cuadro de búsqueda si el campo de entrada está vacío
    if (inputSearch.value === ""){
        box_search.style.display = "none";
    }
}

// Función para ocultar el buscador
function ocultar_buscador(){
    // Oculta la barra de búsqueda
    bars_search.style.top = "-10px";
    cover_ctn_search.style.display = "none";
    inputSearch.value = "";
    box_search.style.display = "none";
}

// Función de filtrado de búsqueda en tiempo real
document.getElementById("inputSearch").addEventListener("keyup", buscador_interno);

function buscador_interno(){
    // Obtiene el valor del campo de entrada y lo convierte a mayúsculas
    filter = inputSearch.value.toUpperCase();
    li = box_search.getElementsByTagName("li"); // Obtiene todos los elementos "li" dentro del cuadro de búsqueda

    // Recorriendo elementos a filtrar mediante los "li"
    for (i = 0; i < li.length; i++){
        a = li[i].getElementsByTagName("a")[0]; // Obtiene el primer elemento "a" dentro de cada "li"
        textValue = a.textContent || a.innerText; // Obtiene el texto del enlace

        // Muestra los elementos que coinciden con el filtro
        if (textValue.toUpperCase().indexOf(filter) > -1){
            li[i].style.display = ""; // Muestra el elemento "li"
            box_search.style.display = "block"; // Muestra el cuadro de búsqueda

            // Oculta el cuadro de búsqueda si el campo de entrada está vacío
            if (inputSearch.value === ""){
                box_search.style.display = "none";
            }
        } else {
            li[i].style.display = "none"; // Oculta el elemento "li" si no coincide con el filtro
        }
    }
}
