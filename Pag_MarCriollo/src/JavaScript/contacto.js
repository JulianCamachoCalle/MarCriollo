const typed = new Typed('.typed', {
    strings: [
        '<i class="contactanoss ">ontactanos </i>', 
        '<i class="contactanoss">ONTACTANOS </i>' 
    ],
    typeSpeed: 75,
    startDelay: 300,
    backSpeed: 75,
    smartBackspace: true,
    shuffle: false,
    backDelay: 1500,
    loop: true,
    loopCount: false,
    showCursor: true,
    cursorChar: '',
    contentType: 'html',
});

emailjs.init('2PycRQz0__5oeSeui');
const form = document.getElementById('form');
form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario
    const btn = document.getElementById('button');
    btn.value = 'Enviando...'; // Cambiar el valor del botón a 'Enviando...' mientras se envía el formulario
    const serviceID = 'default_service'; // ID del servicio de EmailJS
    const templateID = 'template_g18tx0s'; // ID de la plantilla de EmailJS
    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
            // Redirigir al usuario a una página de confirmación
            window.location.href = 'PHP/contacto.php';
        })
        .catch((err) => {
            btn.value = 'Enviar mensaje'; // Cambiar el valor del botón de vuelta a 'Enviar Email' en caso de error
            alert(JSON.stringify(err)); // Mostrar una alerta con el mensaje de error
        });
});