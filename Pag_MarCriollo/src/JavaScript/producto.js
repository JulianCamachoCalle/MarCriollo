// Cambio de imagen del contenedor Grande
function cambiarImagen(imagen) {
    var imagenGrande = document.getElementById("imagen-grande");
    imagenGrande.src = imagen.src;
  }

// Ruleta de tarjeta de platos recomendados - No funcional
document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.conMain-Ruleta');
    const cards = document.querySelectorAll('.tarjeta');
    const nextButton = document.getElementById('next');
    const prevButton = document.getElementById('prev');

    let currentIndex = 0;

    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    nextButton.addEventListener('click', () => {
        if (currentIndex < cards.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarousel();
    });

    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = cards.length - 1;
        }
        updateCarousel();
    });
});



// Ruleta (No implementado) - No funcional
document.addEventListener('DOMContentLoaded', () => {
    const track = document.querySelector('.carousel-track');
    const slides = Array.from(track.children);
    const nextButton = document.querySelector('.botonDer');
    const prevButton = document.querySelector('.botonIzq');
    const slideWidth = slides[0].getBoundingClientRect().width;

    let currentIndex = 0;

    const moveToSlide = (index) => {
        track.style.transform = `translateX(-${slideWidth * index}px)`;
        currentIndex = index;
    };

    nextButton.addEventListener('click', () => {
        if (currentIndex === slides.length - 1) {
            moveToSlide(0);
        } else {
            moveToSlide(currentIndex + 1);
        }
    });

    prevButton.addEventListener('click', () => {
        if (currentIndex === 0) {
            moveToSlide(slides.length - 1);
        } else {
            moveToSlide(currentIndex - 1);
        }
    });
});