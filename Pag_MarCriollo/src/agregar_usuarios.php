<?php
session_start();
include 'PHP/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombres'];
    $direccion = $_POST['direccion'];
    $distrito = $_POST['distritos'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['password'];
    $contrasena2 = $_POST['password2'];

    if (empty($nombre) || empty($direccion) || empty($distrito) || empty($correo) || empty($contrasena) || empty($contrasena2)) {
        echo "<body>";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, rellene todos los campos!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '../usuario.php';
                }
            });
            </script>
            </body>";
        exit();
    }

    if ($contrasena != $contrasena2) {
        echo "<body>";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Las contraseñas no coinciden, por favor verifique!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '../usuario.php';
                }
            });
            </script>
            </body>";
        exit();
    }

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");

    if (mysqli_num_rows($verificar_correo) > 0) {
        echo "<body>";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Este Correo ya está en uso, pruebe con uno diferente!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '../usuario.php';
                }
            });
            </script>
            </body>";
        exit();
    }

    $query = "INSERT INTO usuarios(nombres, direccion, distrito, correo, contrasena) VALUES('$nombre','$direccion','$distrito','$correo','$contrasena')";

    if (mysqli_query($conexion, $query)) {
        echo "<body>";
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Usuario agregado',
                text: 'El usuario ha sido agregado exitosamente!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '../usuario.php';
                }
            });
            </script>
            </body>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/agregar_usuarios.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
        <div class="editar-usuario">
            <div class="contenedor">
                <form action="" method="POST">
                    <h1>Agregar un nuevo Usuario</h1>
                    <input type="text" name="nombres" id="nombres" placeholder="Nombres y Apellidos">
                    <input type="text" name="direccion" id="direccion" placeholder="Dirección">
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
                    <div class="botones-accion">
                        <button type="sumbit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href = '../usuario.php';">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
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