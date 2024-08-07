<?php
session_start();

// Verificar si el usuario está autenticado
$usuario_autenticado = isset($_SESSION['usuario']);

if ($usuario_autenticado) {
    $correo = $_SESSION['usuario'];

    // Incluir el archivo de conexión
    include 'Controlador/BD/Conexion.php';
    
    // Establecer la conexión
    $conexion = new Conexion();
    $con = $conexion->getcon();

    // Consulta a la base de datos para obtener los datos del usuario
    $consulta = $con->prepare("SELECT * FROM usuarios WHERE correo = :correo");
    $consulta->bindParam(':correo', $correo, PDO::PARAM_STR);
    $consulta->execute();
    $datos_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redes Sociales - MarCriollo</title>
    <link rel="stylesheet" href="Recursos/style/redessociales.css">
    <link rel="icon" href="Recursos/img/favicon-32x32.png" type="image/png">
</head>
<body>
<header>
        <div class="contenedorhead">
            <div class="head">
                MarCriollo
            </div>
            <div class="logoprincipal">
                <img src="Recursos/img/crab.png" alt="Logo">
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
            <li><a id="no-seleccionado" href="servicios.php">Servicios</a></li>
            <li><a id="seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="Modelo/JavaScript/headerfooter.js"></script>
    <main>
        <div class="red1">
            <div class="section-title">Nuestras Redes</div>
            <div class="section-description">
                <p>¡Descubre el auténtico sabor de la comida criolla en Mar Criolla! Sumérgete en una experiencia gastronómica única donde cada plato cuenta una historia de tradición y pasión por los sabores locales.
    
                Desde exquisitos platos de mariscos hasta deliciosas opciones de carne criolla, en Mar Criolla te transportamos a los rincones más auténticos de nuestra cultura culinaria. Cada bocado es un viaje a través de los sabores y aromas que hacen de la comida criolla una verdadera joya gastronómica.
                
                ¿Estás listo para explorar? Visita nuestra página web para descubrir nuestro menú completo y tentarte con nuestras especialidades. Además, síguenos en nuestras redes sociales para mantenerte al día con nuestras promociones, eventos especiales y deliciosas novedades culinarias.
                
                ¡Mar Criolla te espera con los brazos abiertos para que disfrutes de una experiencia inolvidable de sabor y tradición!.
                </p>
            </div>
            <button id="scrollUp" onclick="scrollToTop()">↑</button>
        <ul class="social-media">
            <li>
                <a href="https://www.facebook.com/" class="social-link"><img src="Recursos/img/logoface.png" width="31" height="31" alt="Facebook"> Facebook</a>
                <p>Síguenos en Facebook para obtener actualizaciones diarias y participar en nuestras promociones exclusivas.</p>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/eVVfsLg--aA" frameborder="0" allow="autoplay" allowfullscreen></iframe>
            </li>
            <li>
                <a href="https://twitter.com/" class="social-link"><img src="Recursos/img/logox.png" width="31" height="31" alt="Twitter"> Twitter</a>
                <p>Únete a nuestra comunidad en Twitter y mantente informado sobre eventos especiales y noticias de última hora.</p>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/n8YwWZy3bcM" frameborder="0" allow="autoplay"></iframe>
            </li>
            <li>
                <a href="https://web.whatsapp.com/" class="social-link whatsapp"><img src="Recursos/img/logowhat1.png" width="31" height="31" alt="whatsapp"> WhatsApp</a>
                <p>¡Contacta con nosotros a través de WhatsApp y recibe atención personalizada de nuestro equipo!</p>
                <iframe width="100%" height="315" src="https://www.youtube.com/embed/BME9Kzky724" frameborder="0" allow="autoplay" allowfullscreen></iframe>
            </li>
        </ul>
    </main>
    <script src="Modelo/JavaScript/redes sociales.js"></script>
    
<footer>
    <section id="redes">
        <a href="https://www.instagram.com/">
            <img src="Recursos/img/logoig.png" alt="Instagram"></a>
                <a href="https://twitter.com/">
            <img src="Recursos/img/logotw.png" alt="Twitter"></a>
                <a href="https://Facebook.com/">
            <img src="Recursos/img/face.png" alt="Facebook"></a>
    </section>
    Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
    <section id="licencias">
        <a href="https://www.google.com/">Terminos y Condiciones</a>
        <br>
        <a href="https://www.google.com/">Política de Privacidad</a>
    </section>
    <section id="contacto">
        <a href="tel:+51950661842">
            <img src="Recursos/img/telef.png" alt="Telefono">
            +51 950 661 842
        </a>
        <a href="mailto:MarCriollo@gmail.com">
            <img src="Recursos/img/correo.png" alt="Correo">
            MarCriollo@gmail.com
        </a>                
    </section>
    &copy; 2024 Creado por Grupo
</footer>
</body>
</html>