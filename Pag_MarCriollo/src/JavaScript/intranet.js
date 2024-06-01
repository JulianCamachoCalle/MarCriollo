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
    registerForm.submit();
});

// Eventos para el formulario de inicio de sesión
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    loginForm.submit();
});

// Limpiar Campos (Opcional)
function limpiarFormulario(form) {
    const camposEntrada = form.querySelectorAll('input, textarea, select');
    camposEntrada.forEach(campo => {
        campo.value = '';
    });
}
