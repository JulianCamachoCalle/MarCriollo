
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
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mapas - MarCriollo</title>
        <link rel="stylesheet" href="style/mapas.css">
        <link rel="icon" href="img/favicon-32x32.png" type="image/png">
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
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
        </nav>
        <script src="JavaScript/headerfooter.js"></script>

        <main>
            <div class="conPrincipal">
                <div id="conTitulo">
                    <p>Puedes ubícanos en</p>
                </div>
                <div id="conDescripcion">
                    Jirón Salaverry 110 Magdalena del Mar Municipalidad Metropolitana de Lima LIMA, 17
                </div>
                <div id="conMapa">
                    <div id="elemMapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.2418234742413!2d-77.07362976372157!3d-12.095590588194357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c9a4544fd3c1%3A0x59ba9b9dcb6486d!2sRestaurant%20-%20Mar%20Criollo!5e0!3m2!1ses-419!2spe!4v1714323874353!5m2!1ses-419!2spe" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
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
    </body>
</html>