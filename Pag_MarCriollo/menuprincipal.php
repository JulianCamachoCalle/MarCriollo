<?php

// Inicia la sesión
session_start();

// Verifica si la variable de sesión 'usuario' está definida
if (!isset($_SESSION['usuario'])) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Inicia Sesion!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'intranet.php';
            }
        });
        </script>
        </body>";

    // Destruye la sesión
    session_unset();
    session_destroy();
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal - Marcriollo</title>
    <link rel="stylesheet" href="Recursos/style/menuusuario.css">
    <link rel="icon" href="Recursos/img/favicon-32x32.png" type="image/png">
    <script src="https://kit.fontawesome.com/d2b7381cec.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
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
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="Modelo/JavaScript/headerfooter.js"></script>
    <main>
        <div class="contenedor">
            <div class="contenedor-principal">
                <div class="contenedor-foto">
                    <img src="Recursos/img/usuario.webp" alt="img-perfil">
                </div>
                <div class="contenedor-informacion">
                    <div class="contenido_info">
                        <?php

                        if (isset($_SESSION['usuario'])) {
                            $correo = $_SESSION['usuario'];

                            // Establecer la conexion
                            include 'Controlador/BD/Conexion.php';
                            $conexion = new Conexion();
                            $con = $conexion->getcon();

                            // Consulta a la base de datos para obtener los datos del usuario
                            $consulta = $con->prepare("SELECT * FROM usuarios WHERE correo = :correo");
                            $consulta->bindParam(':correo', $correo);
                            $consulta->execute();
                            $datos_usuario = $consulta->fetch(PDO::FETCH_ASSOC);

                            if ($datos_usuario) {
                                // Mostrar los datos del usuario
                                echo '<div class="textnombres">';
                                echo 'Nombres y Apellidos: ' . htmlspecialchars($datos_usuario['nombres'], ENT_QUOTES, 'UTF-8');
                                echo '</div>';
                                echo '<div class="textcorreo">';
                                echo 'Correo: ' . htmlspecialchars($datos_usuario['correo'], ENT_QUOTES, 'UTF-8');
                                echo '</div>';
                                echo '<div class="textdireccion">';
                                echo 'Direccion: ' . htmlspecialchars($datos_usuario['direccion'], ENT_QUOTES, 'UTF-8');
                                echo '</div>';
                                echo '<div class="textdistrito">';
                                echo 'Distrito: ' . htmlspecialchars($datos_usuario['distrito'], ENT_QUOTES, 'UTF-8');
                                echo '</div>';
                            } else {
                                // Si no se encuentran datos del usuario
                                echo '<div class="error">';
                                echo 'No se encontraron datos del usuario.';
                                echo '</div>';
                            }
                        }
                        ?>

                    </div>
                    <div class="cerrar-sesion">
                        <a href="Modelo/PHP/cerrarsesion.php">Cerrar Sesion</a>
                    </div>
                </div>
            </div>
            <div class="contenedor-slider">
                <div class="slider">
                    <img src="Recursos/img/DESC1.png" alt="descuento1">
                    <img src="Recursos/img/DESC2.png" alt="descuento2">
                    <img src="Recursos/img/DESC3.png" alt="descuento3">
                    <img src="Recursos/img/DESC4.png" alt="descuento4">
                    <img src="Recursos/img/DESC5.png" alt="descuento5">
                </div>
            </div>
        </div>
        <script src="Modelo/JavaScript/descuento.js"></script>
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
</body>

</html>