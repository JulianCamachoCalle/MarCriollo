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
  
    // Verificar si el correo ya está registrado
    if (getCookie('user_' + correo)) {
      alert('El correo electrónico ya está registrado. Por favor, utilice otro correo.');
      return;
    }
  
    // Crear una cookie para el nuevo usuario
    setCookie('user_' + correo, JSON.stringify({ nombres, direccion, distrito, correo, password }), 30);
  
    // Ejecutar el registro si todas las validaciones pasan
    console.log('Usuario registrado con éxito!');
    alert('Registro exitoso!');
  
    // Limpiar los campos después del registro
    limpiarCampos();
  
    // Redirigir a la pantalla de inicio de sesión
    window.location.href = 'intranet.html';
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
  
    // Obtener la cookie del usuario
    let userCookie = getCookie('user_' + correo);
  
    if (userCookie) {
      let user = JSON.parse(userCookie);
      if (user.password === password) {
        // Si las credenciales son válidas, redirigir a la página principal
        window.location.href = 'index.html';
      } else {
        // Si la contraseña no es válida, mostrar un mensaje de error
        alert('Contraseña incorrecta. Por favor, inténtalo de nuevo.');
      }
    } else {
      // Si el usuario no existe, mostrar un mensaje de error
      alert('El usuario no está registrado. Por favor, regístrate primero.');
    }
  }
  
  function setCookie(name, value, days) {
    let expires = '';
    if (days) {
      let date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + (value || '') + expires + '; path=/';
  }
  
  function getCookie(name) {
    let nameEQ = name + '=';
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  
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
  
  document.getElementById('btnregistrar').addEventListener('click', register);
  document.getElementById('btniniciar').addEventListener('click', login);