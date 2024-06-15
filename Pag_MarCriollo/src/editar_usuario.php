<?php
session_start();
include "PHP/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigo = $_POST['codigo'];
    $nombres = $_POST['nombres'];
    $direccion = $_POST['direccion'];
    $distrito = $_POST['distritos'];
    $correo = $_POST['correo'];

    // Preparar la consulta SQL para actualizar los datos del usuario
    $actualizar_query = "UPDATE usuarios SET nombres = '$nombres', direccion = '$direccion', distrito = '$distrito', correo = '$correo' WHERE id = '$codigo'";

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conexion, $actualizar_query);

    if ($resultado) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Usuario Editado!',
                text: 'El usuario ha sido editado exitosamente',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../src/usuario.php';
                }
            });
        </script>";
        exit;
    } else {
        die("Error al editar: " . mysqli_error($conexion));
    }
}

// Verifica si se ha proporcionado un ID de usuario en la URL
if (isset($_GET['id'])) {
    // Obtiene el ID del usuario de la URL
    $id_usuario = $_GET['id'];

    // Realiza una consulta para obtener los datos del usuario
    $consulta_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id = $id_usuario");

    if ($consulta_usuario) {
        // Verifica si se encontraron datos del usuario
        if (mysqli_num_rows($consulta_usuario) > 0) {
            // Obtiene los datos del usuario
            $datos_usuario = mysqli_fetch_assoc($consulta_usuario);
            // Asigna los datos del usuario a variables individuales
            $codigo = $datos_usuario['id'];
            $nombres = $datos_usuario['nombres'];
            $direccion = $datos_usuario['direccion'];
            $distrito_usuario = $datos_usuario['distrito'];
            $correo = $datos_usuario['correo'];
        } else {
            echo "No se encontraron datos para el usuario con ID: $id_usuario";
            exit; // Termina la ejecución del script
        }
    } else {
        echo "Error al consultar la base de datos: " . mysqli_error($conexion);
        exit; // Termina la ejecución del script
    }
} else {
    echo "No se proporcionó un ID de usuario en la URL";
    exit; // Termina la ejecución del script
}

$distritos = array("Ancón", "Ate", "Barranco", "Breña", "Carabayllo", "Chaclacayo", "Chorrillos", "Cieneguilla", "Comas", "El Agustino", "Independencia", "Jesús María", "La Molina", "La Victoria", "Lince", "Los Olivos", "Lurigancho", "Lurín", "Magdalena del Mar", "Miraflores", "Pachacámac", "Pucusana", "Pueblo Libre", "Puente Piedra", "Punta Hermosa", "Punta Negra", "Rímac", "San Bartolo", "San Borja", "San Isidro", "San Juan de Lurigancho", "San Juan de Miraflores", "San Luis", "San Martín de Porres", "San Miguel", "Santa Anita", "Santa María del Mar", "Santa Rosa", "Santiago de Surco", "Surquillo", "Villa El Salvador", "Villa María del Triunfo");

?>
<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/editar_usuario.css">
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
                    <h1>Editar Usuario</h1>
                    <input type="text" name="codigo" id="codigo" value="<?php echo $codigo; ?>" placeholder="Código" readonly>
                    <input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>" placeholder="Nombres y Apellidos">
                    <input type="text" name="direccion" id="direccion" value="<?php echo $direccion; ?>" placeholder="Direccion">
                    <select id="distritos" name="distritos">
                        <option value="">Distrito</option>
                        <?php
                        foreach ($distritos as $distrito) {
                            echo "<option value='$distrito'";
                            if ($distrito == $distrito_usuario) {
                                echo " selected";
                            }
                            echo ">$distrito</option>";
                        }
                        ?>
                    </select>
                    <input type="email" name="correo" id="correo" value="<?php echo $correo; ?>" placeholder="Correo">
                    <div class="botones-accion">
                        <button type="sumbit" class="btn btn-success">Guardar</button>
                        <button type="sumbit" class="btn btn-danger">Cerrar</button>
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