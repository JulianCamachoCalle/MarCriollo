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

const btn = document.getElementById('button');
const form = document.getElementById('form');

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

    btn.value = 'Enviando...'; // Cambiar el valor del botón a 'Enviando...' mientras se envía el formulario

    const serviceID = 'default_service'; // ID del servicio de EmailJS
    const templateID = 'template_g18tx0s'; // ID de la plantilla de EmailJS

    // Enviar el formulario utilizando EmailJS
    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
            btn.value = 'Enviar mensaje'; // Cambiar el valor del botón de vuelta a 'Enviar Email' después de enviar el formulario
            alert('¡Enviado!'); // Mostrar una alerta indicando que el mensaje ha sido enviado correctamente
            form.reset(); // Restablecer los valores del formulario
        })
        .catch((err) => {
            btn.value = 'Enviar mensaje'; // Cambiar el valor del botón de vuelta a 'Enviar Email' en caso de error
            alert(JSON.stringify(err)); // Mostrar una alerta con el mensaje de error
        });
});