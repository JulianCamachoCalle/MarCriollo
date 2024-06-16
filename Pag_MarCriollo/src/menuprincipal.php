<?php

//Verificar que haya un inicio de sesion

session_start();

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
                window.location = '../intranet.php';
            }
        });
        </script>
        </body>";
    //Cerrar sesion
    session_destroy();
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal - Marcriollo</title>
    <link rel="stylesheet" href="style/menuprincipal.css">
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
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
            <li><a id="no-seleccionado" href="index.php">Inicio</a></li>
            <li><a id="no-seleccionado" href="nosotros.php">Nosotros</a></li>
            <li><a id="no-seleccionado" href="servicios.php">Servicios</a></li>
            <li><a id="no-seleccionado" href="redessociales.php">Redes Sociales</a></li>
            <li><a id="no-seleccionado" href="mapas.php">Mapas</a></li>
            <li><a id="no-seleccionado" href="contacto.php">Contacto</a></li>
            <li><a id="seleccionado" href="intranet.php">Intranet</a></li>
        </ul>
    </nav>
    <script src="JavaScript/headerfooter.js"></script>
    <main>
        <div class="contenedor">
            <div class="contenedor-principal">
                <div class="contenedor-foto">
                    <img src="img/usuario.webp" alt="img-perfil">
                </div>
                <div class="contenedor-informacion">
                    <div class="contenido_info">
                        <?php
                        // Verificar el inicio de sesion
                        if (isset($_SESSION['usuario'])) {
                            $correo = $_SESSION['usuario'];
                            // Establecer la conexion
                            include 'PHP/conexion.php';
                            // Consulta a la base de datos para obtener los datos del usuario
                            $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
                            $datos_usuario = mysqli_fetch_assoc($consulta);

                            // Mostrar los datos del usuario
                            echo '<div class="textnombres">';
                            echo 'Nombres y Apellidos: ' . $datos_usuario['nombres'];
                            echo '</div>';
                            echo '<div class="textcorreo">';
                            echo 'Correo: ' . $datos_usuario['correo'];
                            echo '</div>';
                            echo '<div class="textdireccion">';
                            echo 'Direccion: ' . $datos_usuario['direccion'];
                            echo '</div>';
                            echo '<div class="textdistrito">';
                            echo 'Distrito: ' . $datos_usuario['distrito'];
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="cerrar-sesion">
                        <a href="PHP/cerrarsesion.php">Cerrar Sesion</a>
                    </div>
                </div>
            </div>
            <div class="contenedor-slider">
                <div class="slider">
                    <img src="img/DESC1.png" alt="descuento1">
                    <img src="img/DESC2.png" alt="descuento2">
                    <img src="img/DESC3.png" alt="descuento3">
                    <img src="img/DESC4.png" alt="descuento4">
                    <img src="img/DESC5.png" alt="descuento5">
                </div>
            </div>
        </div>
        <script src="JavaScript/descuento.js"></script>
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