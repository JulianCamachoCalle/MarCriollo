const fs = require('fs');

const usuariosPath = './usuarios.json';

// Función para leer los usuarios desde el archivo JSON
function leerUsuarios() {
    try {
        const usuariosData = fs.readFileSync(usuariosPath);
        return JSON.parse(usuariosData);
    } catch (error) {
        console.error('Error al leer usuarios:', error);
        return [];
    }
}

// Función para escribir los usuarios en el archivo JSON
function escribirUsuarios(usuarios) {
    try {
        fs.writeFileSync(usuariosPath, JSON.stringify(usuarios, null, 2));
        console.log('Usuarios actualizados correctamente.');
    } catch (error) {
        console.error('Error al escribir usuarios:', error);
    }
}

function register() {
    // Obtener los valores de los campos
    let nombres = document.getElementById('nombres').value;
    let direccion = document.getElementById('direccion').value;
    let distrito = document.getElementById('distritos').value;
    let correo = document.getElementById('correo').value;
    let password = document.getElementById('password').value;
    let password2 = document.getElementById('password2').value;

    // Validar que no haya campos vacíos
    if (!nombres || !direccion || !distrito || !correo || !password || !password2) {
        alert('Por favor, rellene todos los campos.');
        return;
    }

    // Validar que las contraseñas coincidan
    if (password != password2) {
        alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');
        return;
    }

    // Leer los usuarios actuales
    const usuarios = leerUsuarios();

    // Verificar si el correo ya está registrado
    if (usuarios.some(user => user.correo === correo)) {
        alert('El correo electrónico ya está registrado. Por favor, utilice otro correo.');
        return;
    }

    // Agregar el nuevo usuario
    usuarios.push({ nombres, direccion, distrito, correo, password });

    // Escribir los usuarios actualizados en el archivo JSON
    escribirUsuarios(usuarios);

    // Ejecutar el registro si todas las validaciones pasan
    console.log('Usuario registrado con éxito!');
    alert('Registro exitoso!');

    // Limpiar los campos después del registro
    limpiarCampos();

    // Redirigir a la pantalla de inicio de sesión
    window.location.href = 'intranet.html';
};


function limpiarCampos() {
    document.getElementById('nombres').value = '';
    document.getElementById('direccion').value = '';
    document.getElementById('distritos').value = '';
    document.getElementById('correo').value = '';
    document.getElementById('password').value = '';
    document.getElementById('password2').value = '';
}

function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
}

function login() {
    let correo = document.getElementById('correo').value;
    let password = document.getElementById('password').value;

    // Validar datos
    if (correo.trim() === '' || password.trim() === '') {
        alert('Por favor ingrese su correo y contraseña.');
        return;
    } else if (!validateEmail(correo)) {
        alert('Por favor ingrese un correo electrónico válido.');
        return;
    }
    
    // Simulación de búsqueda de usuario en el archivo JSON
    const usuarios = leerUsuarios();
    const usuario = usuarios.find(user => user.correo === correo && user.password === password);

    if (usuario) {
        // Si las credenciales son válidas, redirigir a la página principal
        window.location.href = 'index.html';
    } else {
        // Si las credenciales no son válidas, mostrar un mensaje de error
        alert('Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.');
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