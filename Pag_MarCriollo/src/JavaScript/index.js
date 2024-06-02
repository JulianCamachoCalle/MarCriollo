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


                            //Buscador de contenido


//Ejecutando funciones
document.getElementById("icon-search").addEventListener("click", mostrar_buscador);
document.getElementById("cover-ctn-search").addEventListener("click", ocultar_buscador);

//Declarando variables
bars_search =       document.getElementById("ctn-bars-search");
cover_ctn_search =  document.getElementById("cover-ctn-search");
inputSearch =       document.getElementById("inputSearch");
box_search =        document.getElementById("box-search");


//Funcion para mostrar el buscador
function mostrar_buscador(){

    bars_search.style.top = "80px";
    bars_search.style.display = "block";
    inputSearch.focus();

    if (inputSearch.value === ""){
        box_search.style.display = "none";
    }

}

//Funcion para ocultar el buscador
function ocultar_buscador(){

    bars_search.style.top = "-10px";
    cover_ctn_search.style.display = "none";
    inputSearch.value = "";
    box_search.style.display = "none";

}


//Creando filtrado de busqueda en tiempo real

document.getElementById("inputSearch").addEventListener("keyup", buscador_interno);

function buscador_interno(){


    filter = inputSearch.value.toUpperCase();
    li = box_search.getElementsByTagName("li");

    //Recorriendo elementos a filtrar mediante los "li"
    for (i = 0; i < li.length; i++){

        a = li[i].getElementsByTagName("a")[0];
        textValue = a.textContent || a.innerText;

        if(textValue.toUpperCase().indexOf(filter) > -1){

            li[i].style.display = "";
            box_search.style.display = "block";

            if (inputSearch.value === ""){
                box_search.style.display = "none";
            }

        }else{
            li[i].style.display = "none";
        }

    }



}