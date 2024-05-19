/* Selección de Elementos */
document.addEventListener('DOMContentLoaded', function () {
    const sliderList = document.querySelector('.slider-list');
    const slides = document.querySelectorAll('.slider-list li');
    const prevButton = document.querySelector('.slider-prev');
    const nextButton = document.querySelector('.slider-next');
    let currentIndex = 0;
    const totalSlides = slides.length;

    /* Actualización de la Posición del Slider */
    function updateSliderPosition() {
        sliderList.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    /* Navegación Entre Slides */
    function showNextSlide() {
        if (currentIndex < totalSlides - 1) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateSliderPosition();
    }

    function showPrevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalSlides - 1;
        }
        updateSliderPosition();
    }

    /* Event Listeners */
    nextButton.addEventListener('click', showNextSlide);
    prevButton.addEventListener('click', showPrevSlide);
});