
// Abrir los enlaces de las redes sociales en una nueva pestaña
document.querySelectorAll('.social-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        window.open(this.href, '_blank');
    });
});
