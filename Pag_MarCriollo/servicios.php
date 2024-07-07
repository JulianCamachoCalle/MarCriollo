<?php
session_start();

// Verificar si el usuario está autenticado
$usuario_autenticado = isset($_SESSION['usuario']);

// Si el usuario está autenticado, obtener sus datos
if ($usuario_autenticado) {
    $correo = $_SESSION['usuario'];
    include 'PHP/conexion.php';
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
    $datos_usuario = mysqli_fetch_assoc($consulta);
}
?>
<!DOCTYPE html>
<html lang="es">
<html>
<head> <!-- Información sobre el documento  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - MarCriollo</title>
    <link rel="stylesheet" href="style/servicios.css"> <!-- Hoja de estilos externa llamado servicios.css -->
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
</head>
<body> <!-- Contenido visible de la página web -->
<header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="img/crab.png" alt="Logo">
            </div>
            <div class="info">
            <?php if (!$usuario_autenticado) : ?>
                <!-- Mostrar botones de Iniciar sesión y Registrarse si el usuario no está autenticado -->
                <a href="intranet.php" class="info-link">Iniciar sesión</a>
                <a href="intranet.php" class="info-link">Registrarse</a>
            <?php else : ?>
                <!-- Mostrar nombre de usuario y enlace a intranet.php si el usuario está autenticado -->
                <a href="intranet.php" class="info-link">
                    <div class="textnombres">
                        Usuario: <?php echo $datos_usuario['nombres']; ?>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </header>
    <nav class="navbar">
        <button id="menu-desplegable" class="menu-desplegable" aria-label="Menu Desplegable">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <ul class="opciones">
            <li><a id="no-seleccionado" href="index.php">Inicio</a></li>
            <li><a id="no-seleccionado" href="nosotros.php">Nosotros</a></li>
            <li><a id="seleccionado" href="servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="JavaScript/headerfooter.js"></script>
    <main>
        <div class="contenedor-titulo">
            <div class="titulo">
                <h2>Te brindamos</h2>
            </div>
        </div>
        <section class="services-slider">
            <ul class="slider-list">
                <li class="animate-slide">
                    <img src="images/carrusel1.jpg" alt="Barra y Cocteles">
                    <div class="slider-content">
                        <h3>Barra y Cocteles</h3>
                        <p>Vive un momento especial e inolvidable en nuestro bar...</p>
                        <p>Te esperamos para atenderte...</p>
                    </div>
                </li>
                <li class="animate-slide">
                    <img src="images/carrusel2.jpg" alt="">
                    <div class="slider-content">
                        <h3>Buffet</h3>
                        <p>
                            Contamos con un equipo de chefs, hombres y mujeres con gran
                            experiencia en producción de una gran variedad de menús tipo
                            buffet basados en comida típica de la región.
                        </p>
                        </div>
                    </li>
                    <li class="animate-slide">
                        <img src="images/carrusel3.jpg" alt="">
                        <div class="slider-content">
                            <h3>Catering</h3>
                            <p>Somos tu mejor aliado en servicios de catering para eventos.</p>
                            <p>
                                Nuestro servicio de catering se define como una solución integra
                                y espectacularmente deliciosa para todas tus fiestas y reuniones.
                            </p>
                        </div>
                    </li>
                    <li class="animate-slide">
                        <img src="images/carrusel4.jpg" alt="">
                        <div class="slider-content">
                            <h3>Salón de eventos</h3>
                            <P>
                                Tenemos a su disposición un gran salón climatizado con capacidad para 60 personas,
                                con un maravilloso juego de luces y velos que le dan la escala y ambiente perfecto
                                para engalonar su celebración.
                            </p>
                        </div>
                    </li>
                </ul>
                <button class="slider-prev">&#10094;</button>
                <button class="slider-next">&#10095;</button>
            </section>
        </main>
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
        <script src="JavaScript/sliderservicios.js"></script>
</body>
</html>