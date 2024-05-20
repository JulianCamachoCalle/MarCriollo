// Seleccionar elementos del DOM
const registerForm = document.querySelector('.crear-cuenta form');
const loginForm = document.querySelector('.iniciar-sesion form');
const registerButton = document.getElementById('register');
const loginButton = document.getElementById('login');
const contenedor = document.getElementById('contenedor');

// Eventos para cambiar entre registro e inicio de sesión
registerButton.addEventListener('click', () => {
    contenedor.classList.add('active');
});

loginButton.addEventListener('click', () => {
    contenedor.classList.remove('active');
});

// Eventos para el formulario de registro
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const nombres = registerForm.querySelector('#nombres').value;
    const direccion = registerForm.querySelector('#direccion').value;
    const distrito = registerForm.querySelector('#distritos').value;
    const correo = registerForm.querySelector('#correo').value;
    const password = registerForm.querySelector('#password').value;
    const password2 = registerForm.querySelector('#password2').value;

    if (password === password2) {
        // Crear un objeto usuario
        const usuario = {
            nombres,
            direccion,
            distrito,
            correo,
            password
        };

        // Almacenar el usuario en el almacenamiento local
        let usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        usuarios.push(usuario);
        localStorage.setItem('usuarios', JSON.stringify(usuarios));

        // Mostrar mensaje de éxito
        alert('Registro exitoso!');
        limpiarFormulario();
    } else {
        // Mostrar mensaje de error
        alert('Las contraseñas no coinciden');
    }
});

// Inicio de sesion
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const correo = loginForm.querySelector('input[type="email"]').value;
    const password = loginForm.querySelector('input[type="password"]').value;

    // Obtener los usuarios del almacenamiento local
    const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];

    // Buscar el usuario que coincide con el correo y contraseña
    const usuario = usuarios.find((usuario) => usuario.correo === correo && usuario.password === password);

    if (usuario) {
        // Mostrar mensaje de éxito
        alert('Inicio de sesión exitoso!');
        window.location.href = "index.html";
    } else {
        // Mostrar mensaje de error
        alert('Correo o contraseña incorrectos');
    }
});

// Limpiar Campos
function limpiarFormulario() {
  const form = document.querySelector('form');
  const camposEntrada = form.querySelectorAll('input, textarea, select');
  camposEntrada.forEach(campo => {
    campo.value = '';
  });
}