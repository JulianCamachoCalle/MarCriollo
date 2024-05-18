const mysql = require('mysql2');
// Función para establecer la conexión a la base de datos
function establecerConexion() {
    // Configuración de la conexión a la base de datos
    const conexionConfig = {
        host: 'bv7xx9bbke21yomtrc0m-mysql.services.clever-cloud.com',
        user: 'uu57wycwjgena4uo',
        password: 'tvX7fUiY8xKHp0zVuOMx',
        database: 'bv7xx9bbke21yomtrc0m'
    };

    // Crear la conexión
    const conexion = new mysql.createConnection(conexionConfig);

    // Manejar errores de conexión
    conexion.connect((err) => {
        if (err) {
            console.error('Error al conectar a la base de datos:', err);
            return null;
        }
        console.log('Conexión a la base de datos establecida exitosamente.');
    });

    return conexion; // Retornar la conexión establecida
}

// Inicializar la conexión a la base de datos
let connection = establecerConexion();

function register() {

    // Obtener los valores de los campos
    let nombres = document.getElementById('nombres').value;
    let direccion = document.getElementById('direccion').value;
    let distrito = document.getElementById('distritos').value;
    let correo = document.getElementById('correo').value;
    let password = document.getElementById('password').value;
    let password2 = document.getElementById('password2').value;

    // Crear la consulta de inserción
    let sql = 'INSERT INTO usuarios (nombres, direccion, distrito, correo, password) VALUES (?, ?, ?, ?, ?)';
    let values = [nombres, direccion, distrito, correo, password];

    // Ejecutar la consulta de inserción
    connection.query(sql, values, (error, result) => {
        if (error) {
            console.error('Error al insertar usuario:', error);
            alert('Ocurrió un error al registrar el usuario. Por favor, inténtalo de nuevo.');
        } else {
            console.log('Usuario registrado con éxito:', result);
            alert('Registro exitoso para: ' + nombres);

            // Limpiar los campos después del registro
            limpiarCampos();

            // Redirigir a la pantalla de inicio de sesión
            window.location.href = 'intranet.html';
        }
    });
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
        // Buscar el usuario en la base de datos
        let sql = 'SELECT * FROM usuarios WHERE correo = ?';
        connection.query(sql, [correo], (error, results) => {
            if (error) {
                console.error('Error al consultar usuario:', error);
                alert('Ocurrió un error al iniciar sesión. Por favor, inténtalo de nuevo.');
            } else if (results.length === 0) {
                alert('Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.');
            } else {
                let usuario = results[0];

                // Verificar la contraseña (asumiendo que la contraseña está hasheada)
                if (bcrypt.compareSync(password, usuario.password)) {
                    // Crear una sesión para el usuario
                    createSession(usuario);
                    alert('Inicio de sesión exitoso!');
                } else {
                    alert('Correo o contraseña incorrectos. Por favor, inténtalo de nuevo.');
                }
            }
        });
    }
}

// Función para crear una sesión de usuario
function createSession(usuario) {
    // Generar un token de sesión único
    let sessionToken = generateSessionToken();

    // Almacenar el token de sesión en la base de datos o en una caché
    let sql = 'UPDATE usuarios SET session_token = ? WHERE id = ?';
    connection.query(sql, [sessionToken, usuario.id], (error, result) => {
        if (error) {
            console.error('Error al crear la sesión:', error);
        } else {
            // Almacenar el token de sesión en una cookie o en el almacenamiento del navegador
            localStorage.setItem('session_token', sessionToken);
        }
    });
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