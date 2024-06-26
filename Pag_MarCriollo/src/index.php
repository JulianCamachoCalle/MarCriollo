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
    <title>MarCriollo</title>
    <link rel="stylesheet" href="style/index.css">
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
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
    <button id="scrollUp" onclick="scrollToTop()">↑</button>
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
        <div id="ctn-icon-search">
            <i class="fas fa-search" id="icon-search"></i>
        </div>
        <div id="ctn-icon-cart">
            <a href="carrito.php"><i class="fas fa-shopping-cart" id="icon-cart"></i></a>
        </div>
    </nav>
    <script src="JavaScript/headerfooter.js"></script>

    <div id="ctn-bars-search">
        <input type="text" id="inputSearch" placeholder="¿Qué plato desea buscar?">
        <a href="carrito.php"><button id="all-dishes-button">Todos los platos</button></a>
    </div>

    <ul id="box-search">
        <li><a href="productos/ceviche.php"><i class="fas fa-search"></i>Ceviche</a></li>
        <li><a href="productos/chaufaCecina.php"><i class="fas fa-search"></i>Chaufa de Cecina</a></li>
        <li><a href="productos/chicharronPollo.php"><i class="fas fa-search"></i>Chicharron de Pollo</a></li>
        <li><a href="productos/ensaladaMixta.php"><i class="fas fa-search"></i>Ensalada Mixta</a></li>
        <li><a href="productos/guisoCerdo.php"><i class="fas fa-search"></i>Guiso de Cerdo</a></li>
        <li><a href="productos/lomSaltado.php"><i class="fas fa-search"></i>Lomo Saltado</a></li>
        <li><a href="productos/milanesaPollo.php"><i class="fas fa-search"></i>Milanesa de Pollo</a></li>
        <li><a href="productos/papHuanca.php"><i class="fas fa-search"></i>Papa a la Huancaina</a></li>
        <li><a href="productos/pechugaPlancha.php"><i class="fas fa-search"></i>Pechuga a la Plancha</a></li>
        <li><a href="productos/polloChamp.php"><i class="fas fa-search"></i>Pollo con Champiñon</a></li>
        <li><a href="productos/polloHorno.php"><i class="fas fa-search"></i>Pollo al Horno</a></li>
        <li><a href="productos/sopSemola.php"><i class="fas fa-search"></i>Sopa de Semola</a></li>
        <li><a href="productos/tallVerde.php"><i class="fas fa-search"></i>Tallarin Verde</a></li>
        <li><a href="productos/tamalitoCriollo.php"><i class="fas fa-search"></i>Tamalito Criollo</a></li>
        <li><a href="productos/truchaFrita.php"><i class="fas fa-search"></i>Trucha Frita</a></li>
    </ul>
    <div id="cover-ctn-search"></div>

    <main id="main" class="main">
        <div class="informacion">
            <img src="img/crab.png" alt="crab">
            <h1>Bienvenido a MarCriollo</h1>
            <p>¡Tenemos los platos más ricos de todo el Perú!</p>
            <br>
            <a href="pdf/menu.pdf" download>Menu</a>
        </div>
        <div class="descripcion">
            <div class="division">
                <div class="circulo-verde">
                    <img src="img/cafe.png" width="40" height="40" alt="Telefono">
                </div>
                <br>
                <h2>Desayuno</h2>
                <br>
                <p>Empieza bien el día con nuestro platos</p>
                <p>de 7:30 a 11:00</p>
            </div>
            <div class="division">
                <div class="circulo-gris">
                    <img src="img/tenedor.png" width="30" height="40" alt="Tenedor">
                </div>
                <br>
                <h2>Almuerzo</h2>
                <br>
                <p>Te esperamos para que mejores tu tarde</p>
                <p>de 12:00 a 15:00</p>
            </div>
            <div class="division">
                <div class="circulo-azul">
                    <img src="img/copa.png" width="30" height="40" alt="Copa">
                </div>
                <br>
                <h2>Cena</h2>
                <br>
                <p>Culmina el día de una manera espectacular</p>
                <p>de 19:00 a 23:00</p>
            </div>
        </div>
        <div class="subtitulo">
            <div class="ovalo">
                <h3>Nuestros Platos</h3>
            </div>
        </div>
        <div class="principal">
            <button id="anteriorBtn" onclick="cambiarPlato('anterior')"></button>
            <div class="carrusel">
                <div class="plato">
                    <a href="productos/lomSaltado.html">
                        <img src="img/lomo.jpg" alt="Lomo Saltado"></a>
                    <h5>Lomo Saltado</h5>
                </div>
                <div class="plato">
                    <img src="img/ceviche.jpg" alt="Ceviche">
                    <h5>Ceviche</h5>
                </div>

                <div class="plato">
                    <img src="img/aji.jpg" alt="Aji De Gallina">
                    <h5>Aji De Gallina</h5>
                </div>
                <div class="plato">
                    <img src="img/arrozpollo.jpg" alt="Arroz Con Pollo">
                    <h5>Arroz Con Pollo</h5>
                </div>
                <div class="plato">
                    <img src="img/causa.jpg" alt="Causa">
                    <h5>Causa</h5>
                </div>
                <div class="plato">
                    <img src="img/tacutacu.jpg" alt="Tacu Tacu">
                    <h5>Tacu Tacu</h5>
                </div>
                <div class="plato">
                    <img src="img/tallarineshuancaina.jpg" alt="Tallarines a La Huancaina">
                    <h5>Tallarines</h5>
                </div>
            </div>
            <button id="siguienteBtn" onclick="cambiarPlato('siguiente')"></button>
        </div>
        <div class="final">
            <div class="texto">
                Nuestra cocina es saludable y solo usamos productos nacionales. Nuestro trabajo es innovar
                constantemente nuestros productos y recetas sin dejar de respetar los productos de
                temporada y la naturaleza
                <br><br>
                En nuestro restaurante siempre encontrarás comida saludable. No dudes en visitarnos para
                disfrutar, podrás encontrar bebidas nutritivas y deliciosos postres para satisfacer tus
                antojos de algo dulce. Todos los días podrás probar nuestro especial del día.
            </div>
        </div>
    </main>
    <script src="JavaScript/index.js"></script>
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