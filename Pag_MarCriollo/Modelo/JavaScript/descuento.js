document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slider img');
    let currentPosition = 0;
    const slideWidth = slides[0].clientWidth;

    function moveSlides() {
        currentPosition -= 1;
        slider.style.transform = `translateX(${currentPosition}px)`;

        if (currentPosition <= -slideWidth) { 
            currentPosition += slideWidth;
            slider.appendChild(slides[0]);
            slider.style.transform = `translateX(${currentPosition}px)`;
        }
    }

    setInterval(moveSlides, 20);
});
