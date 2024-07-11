/* CAMBIO DE IMAGEN AL PRESIONAR */

// Cambio de imagen del contenedor Grande
/*function cambiarImagen(imagen) {
    console.log("Hola");
    var imagenGrande = document.getElementById("imagen-grande");
    imagenGrande.src = imagen.src;
  }*/


/* MOSTRAR TARJETAS ALEATORIAS (class="conMain-Ruleta") */
const platos = [
    {   // Ceviche
        img: "../productos/img/cevice_N.png",
        tipo: "- Plato de Entrada -",
        nombre: "Ceviche",
        link: "../productos/ceviche.php"
    },
    {   // Chaufa de Cecina
        img: "../productos/img/chaufaCecina_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Chaufa de Cecina c/Platano",
        link: "../productos/chaufaCecina.php"
    },
    {   // Chicharron de Pollo
        img: "../productos/img/chicharronPollo_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Chicharron de Pollo c/Papas",
        link: "../productos/chicharronPollo.php"
    },
    {   // Ensalada Mixta
        img: "../productos/img/ensalada_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Ensalada Mixta c/Verduras",
        link: "../productos/ensaladaMixta.php"
    },
    {   // Guiso de Cerdo
        img: "../productos/img/guisoCerdo_N.png",
        tipo: "- Plato de Fondo -",
        nombre: "Guiso de Cerdo con Camote",
        link: "../productos/guisoCerdo.php"
    },
    {   // Lomo Saltado
        img: "../productos/img/lomo_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Lomo Saltado",
        link: "../productos/lomSaltado.php"
    },
    {   // Milanesa de Pollo
        img: "../productos/img/milanesa_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Milanesa de Pollo c/Papas",
        link: "../productos/milanesaPollo.php"
    },
    {   // Papa a la Huancaina
        img: "../productos/img/papHuancaina_N.png",
        tipo: "- Plato de Entrada -",
        nombre: "Papa a la Huancaina",
        link: "../productos/papHuanca.php"
    },
    {   // Pechuga a la Plancha
        img: "../productos/img/pechugaPlancha_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Pechuga a la Plancha c/Papas",
        link: "../productos/pechugaPlancha.php"
    },
    {   // Pollo con Champiñon
        img: "../productos/img/polloChamp_N.png",
        tipo: "- Plato de Fondo -",
        nombre: "Pollo con Champiñones con Papas",
        link: "../productos/polloChamp.php"
    },
    {   // Pollo al Horno
        img: "../productos/img/polloHorno_N.png",
        tipo: "- Plato de Fondo -",
        nombre: "Pollo al Horno",
        link: "../productos/polloHorno.php"
    },
    {   // Sopa de Semola
        img: "../productos/img/sopSemola_N.png",
        tipo: "- Plato de Entrada -",
        nombre: "Sopa de Semola con Pollo",
        link: "../productos/sopSemola.php"
    },
    {   // Tallarin Verde
        img: "../productos/img/tallVer_N.png",
        tipo: "- Plato de Fondo -",
        nombre: "Tallarin Verde",
        link: "../productos/tallVerde.php"
    },
    {   // Tamalitos Criollos
        img: "../productos/img/tamal_N.png",
        tipo: "- Plato de Entrada -",
        nombre: "Tamalito Criollo",
        link: "../productos/tamalitoCriollo.php"
    },
    {   // Tamalitos Criollos
        img: "../productos/img/trucha_N.png",
        tipo: "- Plato Ejecutivo -",
        nombre: "Trucha Frita c/Yuca y Arroz",
        link: "../productos/truchaFrita.php"
    }

    // Puedes agregar más platos aquí ...
];

function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

function generarContenedores(numContenedores) {
    const contenedorPrincipal = document.querySelector('.conMain-Ruleta');
    contenedorPrincipal.innerHTML = '';  // Limpiar contenido previo
    const platosAleatorios = shuffle(platos.slice()).slice(0, numContenedores);

    platosAleatorios.forEach(plato => {
        const tarjeta = document.createElement('div');
        tarjeta.classList.add('tarjeta');
        
        const imgDiv = document.createElement('div');
        imgDiv.classList.add('img-tarjeta');
        const img = document.createElement('img');
        img.src = plato.img;
        img.alt = "Imagen";
        imgDiv.appendChild(img);
        
        const tipoDiv = document.createElement('div');
        tipoDiv.classList.add('tipo-tarjeta');
        tipoDiv.textContent = plato.tipo;
        
        const nombreDiv = document.createElement('div');
        nombreDiv.classList.add('txt-tarjeta');
        nombreDiv.textContent = plato.nombre;
        
        const link = document.createElement('a');
        link.href = plato.link;
        link.classList.add('boton-tarjeta');
        link.textContent = "ver plato";
        
        tarjeta.appendChild(imgDiv);
        tarjeta.appendChild(tipoDiv);
        tarjeta.appendChild(nombreDiv);
        tarjeta.appendChild(link);

        contenedorPrincipal.appendChild(tarjeta);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const numContenedores = 3; // Cambia este número para generar más contenedores
    generarContenedores(numContenedores);
});
/* A4 */


/* */
// Obtener elementos del DOM
const overlayButton = document.getElementById('overlayButton');
const overlayContainer = document.getElementById('overlayContainer');
const closeOverlayButton = document.getElementById('closeOverlayButton');
const closeButton = document.querySelector('.close-button');

// Importar la función que carga el modelo 3D
import { loadModel3D } from "./three-model.js";

// Mostrar el overlay al hacer clic en el botón
overlayButton.addEventListener('click', () => {
    overlayContainer.style.display = 'flex'; // Mostrar el contenedor del overlay
    loadModel3D(); // Llamar a la función que carga el modelo 3D
});

// Ocultar el overlay al hacer clic en el botón de cerrar
closeOverlayButton.addEventListener('click', () => {
    overlayContainer.style.display = 'none'; // Ocultar el contenedor del overlay
});

// Cerrar el overlay al hacer clic en el botón circular
closeButton.addEventListener('click', () => {
    overlayContainer.style.display = 'none'; // Ocultar el contenedor del overlay
});