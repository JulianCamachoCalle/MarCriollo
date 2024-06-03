//letras de contactanos
const typed = new Typed('.typed', {
    strings: [
        '<i class="contactanoss ">ontactenos </i>', 
        '<i class="contactanoss">ONTACTENOS </i>' 
    ],
    stringsElement: '#cadenas-texto',//ID del elemento que contiene cadenas de texto por mostrar.
    typeSpeed: 75,//Velocidad en milisegundos para poner una letra.
    startDelay: 300,//Tiempo de retraso para mostrar la aminacion.
    backSpeed: 75,//Velocidad en milisegundos para borrar una letra.
    smartBackspace: true,//Eliminar solamente las palabras que sean nuevas en una cadana de texto.
    shuffle: false,//Alterar el orden en el que escribe las palabras.
    backDelay: 1500,//tiempo en espera despues de que termine una palabra.
    loop: true,//repetit el array de strings.
    loopCount: false,//Cantidad de veces a repetir el array: false= infinito.
    showCursor: true,//mostrrar cursor palpitante.
    cursorChar: '',//Caracter para el cursor.
    contentType: 'html',// html o null para texto sin formato.
});
//formulario
document.getElementById("form").addEventListener("submit", function(event) {
  event.preventDefault();

  // Obtener datos del formulario
  const formData = new FormData(this);

  // Enviar datos usando Fetch API
  fetch(this.action, {
      method: this.method,
      body: formData
  })
  .then(response => response.text())
  .then(data => {
      // Mostrar mensaje de éxito con SweetAlert2
      Swal.fire({
          title: "¡Mensaje enviado!",
          text: data,
          icon: "success"
      });
      // Restablecer el formulario
      document.getElementById("form").reset();
  })
  .catch(error => {
      // Mostrar mensaje de error en la consola
      console.error('Error:', error);
      // Mostrar mensaje de error con SweetAlert2
      Swal.fire({
          title: "Error",
          text: "Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.",
          icon: "error"
      });
  });

  // Envía el formulario utilizando EmailJS
  emailjs.sendForm('default_service', 'template_g18tx0s', this)
      .then(function(response) {
          console.log('Success!', response.status, response.text);
      }, function(error) {
          console.error('Failed...', error);
      });
});