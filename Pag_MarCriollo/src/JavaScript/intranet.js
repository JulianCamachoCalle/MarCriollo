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