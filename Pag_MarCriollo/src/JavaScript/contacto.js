//letras de contactanos
const typed = new Typed('.typed', {
    strings: [
        '<i class="contactanoss ">ontactanos </i>', 
        '<i class="contactanoss">ONTACTANOS </i>' 
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
const btn = document.getElementById('button'); //esta capturando el boton

document.getElementById('form') // caprtura el id del fotmulario
 .addEventListener('submit', function(event) {
   event.preventDefault();

   btn.value = 'Enviando...';//el boton va a decir enviando

   const serviceID = 'default_service';
   const templateID = 'template_g18tx0s';

   emailjs.sendForm(serviceID, templateID, this)// parametros
    .then(() => {
      btn.value = 'Enviar mensaje';
      alert('Enviado!');// si sale todo bien va a salir enviado
    }, (err) => {
      btn.value = 'Enviar mensaje';
      alert(JSON.stringify(err));//saldra error
    });
});