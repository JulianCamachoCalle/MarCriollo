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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo - Nosotros</title>
    <link rel="stylesheet" href="style/nosotros.css">
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
            <li><a id="seleccionado" href="index.php">Inicio</a></li>
            <li><a id="no-seleccionado" href="nosotros.php">Nosotros</a></li>
            <li><a id="no-seleccionado" href="servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="JavaScript/headerfooter.js"></script>
    
    <!-- ... -->

    <main>
        <div class="conVideo">
            <video autoplay loop muted playsinline>
                <source src="img/Cinematic_Restaurant.mp4" type="video/mp4">
            </video>
            <div id="capaGris"></div>
            <div id="texCocina">
                <p>- sobre nosotros -</p>
            </div>
        </div>
        <div class="conTex-Presentacion">
            <div id="conBig-Text">
                <h1>UN SUEÑO HECHO REALI­DAD.</h1>
            </div>
            <div id="conShort-Text01">
                <p>En <b>MarCriollo</b>, nos enorgullece ofrecer una experiencia gastronómica única que celebra la rica tradición culinaria de nuestra tierra. Es aquí, entre las brisas saladas del mar y el aroma de las especias criollas, donde nace nuestra pasión por la comida.</p>
            </div>
            <div id="conShort-Text02">
                <p>En <b>MarCriollo</b>, nos enorgullece ofrecer una experiencia gastronómica única que celebra la rica tradición culinaria de nuestra tierra. Es aquí, entre las brisas saladas del mar y el aroma de las especias criollas, donde nace nuestra pasión por la comida.</p>
            </div>
        </div>
        <div class="conVid-Primero">
            <div id="conTex-Frase">
                <h1>"Decidieron emprender un viaje para crearlo ellos mismos"</h1>
            </div>
            <div id="conVideo">
                <iframe width="100%" height="100%"
                    src="https://www.youtube.com/embed/n8YwWZy3bcM"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
        <div class="conTex-Fundador">
            <div id="titulo">
                <h1 id="tit01">nuestro fundador</h1>
                <h1 id="tit02">diego navarro</h1>
                <p>De las aguas del conocimiento, emergió un pescador convertido en chef autodidacta, sazonando la vida con su pasión por los sabores del mar.</p>
            </div>
            <div id="conImg">
                <div id="conTexto">
                    <h1>"Su pasión por la cocina costera lo convirtió en un referente en la escena gastronómica marina del país".</h1>
                </div>
                <img src="img/cocina.jpg" id="carta01">
                <img src="img/familia.jpg" id="carta02">
                <img src="img/fundador.jpg" id="carta03"> <!-- Imagen Principal -->
            </div>
        </div>
        <div class="conMetas">
            <div id="conCuadros">
                <div id="conMision">
                    <h1>mision</h1>
                    <p>MarCriollo ofrece una fusión única de cocina marina y criolla. Con pasión por la frescura, cada plato refleja autenticidad y atención al detalle. Nuestra mision es deleitar a los clientes con sabores inigualables, invitándolos a un viaje culinario que celebra nuestras tradiciones y el esplendor del mar.</p>
                </div>
                <div id="conVision">
                    <h1>Vision</h1>
                    <p>En MarCriollo, aspiramos a ser el destino gastronómico de referencia para los amantes de los sabores criollos y marinos en un ambiente acogedor. Destacamos por nuestra excelencia culinaria y atención al cliente, siendo un lugar donde cada experiencia sea única y memorable, dejando una huella duradera en nuestros clientes y en la comunidad gastronómica.</p>
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