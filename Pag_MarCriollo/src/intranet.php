<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header("location: menuprincipal.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo</title>
    <link rel="stylesheet" href="style/intranet.css">
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    <script src="https://kit.fontawesome.com/d2b7381cec.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
    <header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="img/crab.png" alt="Logo">
            </div>
        </div>
    </header>
    <nav class="navbar">
        <button id="menu-desplegable" class="menu-desplegable" aria-label="Menu Desplegable">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="opciones">
            <li><a id="no-seleccionado" href="index.html">Inicio</a></li>
            <li><a id="no-seleccionado" href="nosotros.html">Nosotros</a></li>
            <li><a id="no-seleccionado" href="servicios.html">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.html">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.html">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.html">Contacto</a></li>
            <li><a id="seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="JavaScript/headerfooter.js"></script>
    <main id="main" class="main">
        <div class="contenedor" id="contenedor">
            <div class="form-contenedor crear-cuenta">
                <form action="PHP/registrar.php" method="POST">
                    <h1>Create una Cuenta</h1>
                    <div class="social-iconos">
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-google-plus-g"></i>
                        </a>
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                    <span>O usa tu correo y contraseña</span>
                    <input type="name" name="nombres" id="nombres" placeholder="Nombres y Apellidos">
                    <input type="direccion" name="direccion" id="direccion" placeholder="Direccion">
                    <select id="distritos" name="distritos">
                        <option value="">Distrito</option>
                        <?php
                        
                        $distritos = array("Ancón", "Ate", "Barranco", "Breña", "Carabayllo", "Chaclacayo", "Chorrillos", "Cieneguilla", "Comas", "El Agustino", "Independencia", "Jesús María", "La Molina", "La Victoria", "Lince", "Los Olivos", "Lurigancho", "Lurín", "Magdalena del Mar", "Miraflores", "Pachacámac", "Pucusana", "Pueblo Libre", "Puente Piedra", "Punta Hermosa", "Punta Negra", "Rímac", "San Bartolo", "San Borja", "San Isidro", "San Juan de Lurigancho", "San Juan de Miraflores", "San Luis", "San Martín de Porres", "San Miguel", "Santa Anita", "Santa María del Mar", "Santa Rosa", "Santiago de Surco", "Surquillo", "Villa El Salvador", "Villa María del Triunfo");

                        foreach ($distritos as $distrito) {
                            echo "<option value='$distrito'>$distrito</option>";
                        }
                        ?>
                    </select>
                    <input type="email" name="correo" id="correo" placeholder="Correo">
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                    <input type="password" name="password2" id="password2" placeholder="Repetir Contraseña">
                    <button type="submit" name="registro">Registrarse</button>
                </form>
            </div>
            <div class="form-contenedor iniciar-sesion">
                <form action="PHP/iniciosesion.php" method="POST">
                    <h1>Inicia Sesion</h1>
                    <div class="social-iconos">
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-google-plus-g"></i>
                        </a>
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                        <a href="#" class="iconos">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </div>
                    <span>Usa tu correo y contraseña</span>
                    <input type="email" name="correo" placeholder="Correo">
                    <input type="password" name="password" placeholder="Contraseña">
                    <a href="#">Olvidaste tu contraseña?</a>
                    <button>Iniciar Sesion</button>
                </form>
            </div>
            <div class="cambiar-contenedor">
                <div class="cambiar">
                    <div class="cambiar-panel cambiar-izquierda">
                        <h1>Bienvenido!</h1>
                        <p>Ingresa todos tus datos correspondientes</p>
                        <button class="ocultar" id="login">Iniciar Sesion</button>
                    </div>
                    <div class="cambiar-panel cambiar-derecha">
                        <h1>Buen Dia!</h1>
                        <p>Registra todos tus datos!</p>
                        <button class="ocultar" id="register">Registrarse</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="JavaScript/intranet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <footer>
        <section id="redes">
            <a href="https://www.instagram.com/">
                <img src="img/logoig.png" alt="Instagram"></a>
            <a href="https://twitter.com/">
                <img src="img/logotw.png" alt="Twitter"></a>
            <a href="https://Facebook.com/">
                <img src="img/face.png" alt="Facebook"></a>
        </section>
        Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
        <section id="licencias">
            <a href="https://www.google.com/">Terminos y Condiciones</a>
            <br>
            <a href="https://www.google.com/">Política de Privacidad</a>
        </section>
        <section id="contacto">
            <a href="tel:+51950661842">
                <img src="img/telef.png" alt="Telefono">
                +51 950 661 842
            </a>
            <a href="mailto:MarCriollo@gmail.com">
                <img src="img/correo.png" alt="Correo">
                MarCriollo@gmail.com
            </a>
        </section>
        &copy; 2024 Creado por Grupo
    </footer>
</body>

</html>