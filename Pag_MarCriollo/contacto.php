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
        <title>MarCriollo</title>
        <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="Recursos/style/contacto.css">
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
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="Modelo/JavaScript/headerfooter.js"></script>
    <h2 class="contactanos" >C<span class="typed"></span> </h2>
    <main>
        <section class="ladoizquierdo">
            <div>
                <div>
                <img  src="Recursos/img/chefcara.jpg" class="contactocara">
                </div>
                <p class="informacion">CONTACTO </p>   
                <a class="chefcont" href="tel:+51950661842">
                    <img src="Recursos/img/telef.png" width="15" height="15" alt="Telefono">
                    +51 950 661 842
                </a>
                <p class="info2">
                    ¡Llámanos para hacer una reserva o para cualquier consulta! Nuestro equipo estará encantado de atenderte y ayudarte con cualquier pregunta que tengas sobre nuestro delicioso menú y nuestros servicios. ¡Esperamos tu llamada!</p>
            </div>
        </section>
        <form id="form" action="PHP/Contacto.php" method="post">
        <section class="ladoderecho">
            <div class="input-group">
                <label for="from_name">Nombre</label>
                <input type="text" name="from_name" placeholder="Nombre" id="from_name">
                <br>
                <label for="phone_id">Numero de telefono</label>
                <input type="tel" name="phone_id" id="phone_id" placeholder="Telefono">
                <br>
                <label for="email">Correo electronico</label>
                <input type="email" name="email_id" id="email_id" placeholder="Correo electronico">
                <br>
                <label for="affair_id">Asunto</label>
                <input type="text" name="affair_id" id="affair_id">
                <br>
                <label for="message">Pregunta</label>
                <br>
                <textarea name="message" id="message" cols="30" rows="5" placeholder="Mensaje"></textarea>
                <br>
                <input type="submit" class="btn-enviar" name="enviar" value="Enviar mensaje" id="button">
            </div>
        </section>   
    </form>
    </main>
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
    
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>

    <script type="text/javascript">
        emailjs.init('2PycRQz0__5oeSeui')</script>

    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2.6.4/dist/email.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Modelo/JavaScript/contacto.js"></script>



    
</body>
</html>