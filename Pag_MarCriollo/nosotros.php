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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo - Nosotros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link rel="stylesheet" href="Recursos/style/nosotros.css">
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
            <li><a id="seleccionado" href="nosotros.php">Nosotros</a></li>
            <li><a id="no-seleccionado" href="servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="no-seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="Modelo/JavaScript/headerfooter.js"></script>
    
    <!-- ... -->

    <main>
        <div class="conVideo">
            <video autoplay loop muted playsinline>
                <source src="Recursos/img/Cinematic_Restaurant.mp4" type="video/mp4">
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

        <section class="container my-5" id="carrus">
            <h2 class="section-title text-center">Misión y Visión</h2>
            <div id="missionVisionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" id="carrusImg">
                        <img src="Recursos/img/mision.jpg" class="d-block w-100" alt="Misión">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3">
                            <h3>Misión</h3>
                            <p>Nuestra misión es ofrecer una experiencia gastronómica excepcional que celebre los sabores del mar, utilizando ingredientes frescos y sostenibles, y brindando un servicio cálido y acogedor a cada uno de nuestros clientes.</p>
                        </div>
                    </div>
                    <div class="carousel-item" id="carrusImg">
                        <img src="Recursos/img/familia.jpg" class="d-block w-100" alt="Visión">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3">
                            <h3>Visión</h3>
                            <p>Ser reconocidos como el restaurante líder en cocina marina en la región, destacándonos por nuestra innovación culinaria, nuestro compromiso con la calidad y nuestra dedicación a la satisfacción del cliente.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#missionVisionCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#missionVisionCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </section>

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
                <img src="Recursos/img/cocina.jpg" id="carta01">
                <img src="Recursos/img/fondo2.jpeg" id="carta02">
                <img src="Recursos/img/fundador.jpg" id="carta03"> <!-- Imagen Principal -->
            </div>
        </div>

        <section class="bg-light py-5">
            <div class="container">
                <h2 class="section-title text-center">Nuestro Equipo</h2>
                <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="Recursos/img/juan_perez.jpg" class="card-img-top" alt="Team Member 1">
                                        <div class="card-body">
                                            <h5 class="card-title">Juan Pérez</h5>
                                            <p class="card-text">Chef Ejecutivo</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="Recursos/img/ana_lopez.jpg" class="card-img-top" alt="Team Member 2">
                                        <div class="card-body">
                                            <h5 class="card-title">Ana López</h5>
                                            <p class="card-text">Chef Pastelera</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="Recursos/img/carlos_garcia.jpg" class="card-img-top" alt="Team Member 3">
                                        <div class="card-body">
                                            <h5 class="card-title">Carlos García</h5>
                                            <p class="card-text">Gerente de Restaurante</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="Recursos/img/maria_fernandez.jpg" class="card-img-top" alt="Team Member 4">
                                        <div class="card-body">
                                            <h5 class="card-title">María Fernández</h5>
                                            <p class="card-text">Sommelier</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="Recursos/img/pedro_sanchez.jpg" class="card-img-top" alt="Team Member 5">
                                        <div class="card-body">
                                            <h5 class="card-title">Pedro Sánchez</h5>
                                            <p class="card-text">Jefe de Cocina</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img src="Recursos/img/laura_torres.jpg" class="card-img-top" alt="Team Member 6">
                                        <div class="card-body">
                                            <h5 class="card-title">Laura Torres</h5>
                                            <p class="card-text">Encargada de Eventos</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </section>    

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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>