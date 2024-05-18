// Arreglo para almacenar los usuarios registrados
let usuariosRegistrados = [];

// Función para registrar usuario
function register() {
    // Obtener los valores de los campos
    let nombres = document.getElementById('nombres').value;
    let direccion = document.getElementById('direccion').value;
    let distrito = document.getElementById('distritos').value;
    let correo = document.getElementById('correo').value;
    let password = document.getElementById('password').value;
    let password2 = document.getElementById('password2').value;

    // Validar si se ingresaron datos
    if (nombres.trim() === '' || direccion.trim() === '' || distrito === '' || correo.trim() === '' || password.trim() === '' || password2.trim() === '') {
        alert('Por favor complete todos los campos.');
    } else if (!validateEmail(correo)) {
        alert('Por favor ingrese un correo electrónico válido.');
    } else if (password !== password2) {
        alert('Las contraseñas no coinciden.');
    } else {
        // Verificar si el correo ya está registrado
        let usuarioExistente = usuariosRegistrados.find(user => user.correo.toLowerCase() === correo.toLowerCase());
        if (usuarioExistente) {
            alert('El correo ya está registrado.');
        } else {
            // Crear un objeto con los datos del usuario
            let nuevoUsuario = {
                nombres: nombres,
                direccion: direccion,
                distrito: distrito,
                correo: correo,
                password: password
            };

            // Agregar el usuario al arreglo de usuarios registrados
            usuariosRegistrados.push(nuevoUsuario);

            alert('Registro exitoso para: ' + nombres);

            // Limpiar los campos después del registro
            limpiarCampos();

            // Redirigir a la pantalla de inicio de sesión
            window.location.href = 'intranet.html';
        }
    }
}

// Función para limpiar los campos después del registro
function limpiarCampos() {
    document.getElementById('nombres').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('distritos').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('password').value = '';
    document.getElementById('password2').value = '';
}

// Función para validar un correo electrónico
function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}

// Función para mostrar u ocultar la contraseña
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}

// Función para iniciar sesión
function login() {
    let correo = document.getElementById('correo').value;
    let password = document.getElementById('password').value;

    // Validar datos
    if (correo.trim() === '' || password.trim() === '') {
        alert('Por favor ingrese su correo y contraseña.');
    } else if (!validateEmail(correo)) {
        alert('Por favor ingrese un correo electrónico válido.');
    } else {
        let usuarioEncontrado = usuariosRegistrados.find(user => user.correo === correo && user.password === password);
        if (usuarioEncontrado) {
            alert('Inicio de sesión exitoso!');
        } else {
            alert('Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.');
        }
    }
}

function recordarSeleccion() {
    let recordarCheckbox = document.getElementById('recordar');
    
    if (recordarCheckbox.checked) {
        localStorage.setItem('recordarSeleccion', 'true');
    } else {
        localStorage.removeItem('recordarSeleccion');
    }
}

function cargarSeleccion() {
    let recordarCheckbox = document.getElementById('recordar');
    
    if (localStorage.getItem('recordarSeleccion')) {
        recordarCheckbox.checked = true;
    }
}

document.getElementById('recordar').addEventListener('change', recordarSeleccion);
document.getElementById('btnregistrar').addEventListener('click', register);
document.getElementById('btniniciar').addEventListener('click', login);

cargarSeleccion();