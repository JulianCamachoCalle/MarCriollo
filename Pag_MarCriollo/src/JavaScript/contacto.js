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
const btn = document.getElementById('button');

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

    // Validación de campos
    const nombre = document.getElementById('from_name').value.trim();
    const telefono = document.getElementById('phone_id').value.trim();
    const email = document.getElementById('email_id').value.trim();
    const asunto = document.getElementById('affair_id').value.trim();
    const mensaje = document.getElementById('message').value.trim();

    if (!nombre || !telefono || !email || !asunto || !mensaje) {
        Swal.fire({
            title: "Error",
            text: "Por favor, complete todos los campos.",
            icon: "error"
        });
        return; // Detener el envío del formulario si falta algún campo
    }

    btn.value = 'Enviando...'; // Cambiar el valor del botón a 'Enviando...' mientras se envía el formulario

    const serviceID = 'default_service'; // ID del servicio de EmailJS
    const templateID = 'template_g18tx0s'; // ID de la plantilla de EmailJS

    // Enviar el formulario utilizando EmailJS
    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
            btn.value = 'Enviar Email'; // Cambiar el valor del botón de vuelta a 'Enviar Email' después de enviar el formulario
            Swal.fire({
                title: "¡Excelente!",
                text: "¡Has enviado el mensaje correctamente!",
                icon: "success"
            });
            form.reset(); // Limpiar el formulario después de enviar el mensaje
        })
        .catch((err) => {
            btn.value = 'Enviar Email'; // Cambiar el valor del botón de vuelta a 'Enviar Email' en caso de error
            Swal.fire({
                title: "Error",
                text: "Hubo un problema al enviar el mensaje. Inténtalo de nuevo más tarde.",
                icon: "error"
            });
        });
});