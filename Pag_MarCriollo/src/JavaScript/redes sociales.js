
// Abrir los enlaces de las redes sociales en una nueva pestaña
document.querySelectorAll('.social-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        window.open(this.href, '_blank');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    themeToggle.addEventListener('click', function() {
        body.classList.toggle('light-theme');
        body.classList.toggle('dark-theme');
    });
});