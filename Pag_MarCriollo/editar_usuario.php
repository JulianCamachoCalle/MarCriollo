<?php
session_start();
include "Controlador/BD/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigo = $_POST['codigo'];
    $nombres = $_POST['nombres'];
    $direccion = $_POST['direccion'];
    $distrito = $_POST['distritos'];
    $correo = $_POST['correo'];

    try {
        // Establecer la conexión
        $conexion = new Conexion();
        $con = $conexion->getcon();

        // Preparar la consulta SQL para actualizar los datos del usuario
        $actualizar_query = "UPDATE usuarios SET nombres = :nombres, direccion = :direccion, distrito = :distrito, correo = :correo WHERE id = :codigo";
        $stmt = $con->prepare($actualizar_query);
        $stmt->bindParam(':nombres', $nombres, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':distrito', $distrito, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar el éxito de la consulta
        if ($stmt->rowCount() > 0) {
            echo "<body>";
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
                        window.location.href = 'usuario.php';
                    }
                });
            </script>
            </body>";
            exit;
        } else {
            echo "No se realizaron cambios";
        }
    } catch (PDOException $e) {
        echo "Error al actualizar usuario: " . $e->getMessage();
    }
}

// Verificar si se ha proporcionado un ID de usuario en la URL
if (isset($_GET['id'])) {
    // Obtiene el ID del usuario de la URL
    $id_usuario = $_GET['id'];

    try {
        // Establecer la conexión
        $conexion = new Conexion();
        $con = $conexion->getcon();

        // Realizar una consulta para obtener los datos del usuario
        $consulta_usuario = $con->prepare("SELECT * FROM usuarios WHERE id = :id");
        $consulta_usuario->bindParam(':id', $id_usuario, PDO::PARAM_INT);
        $consulta_usuario->execute();

        // Verificar si se encontraron datos del usuario
        if ($consulta_usuario->rowCount() > 0) {
            // Obtener los datos del usuario
            $datos_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
            // Asignar los datos del usuario a variables individuales
            $codigo = $datos_usuario['id'];
            $nombres = $datos_usuario['nombres'];
            $direccion = $datos_usuario['direccion'];
            $distrito_usuario = $datos_usuario['distrito'];
            $correo = $datos_usuario['correo'];
        } else {
            echo "No se encontraron datos para el usuario con ID: $id_usuario";
            exit; // Terminar la ejecución del script
        }
    } catch (PDOException $e) {
        echo "Error al consultar la base de datos: " . $e->getMessage();
    }
} else {
    echo "No se proporcionó un ID de usuario en la URL";
    exit; // Terminar la ejecución del script
}

$distritos = array("Ancón", "Ate", "Barranco", "Breña", "Carabayllo", "Chaclacayo", "Chorrillos", "Cieneguilla", "Comas", "El Agustino", "Independencia", "Jesús María", "La Molina", "La Victoria", "Lince", "Los Olivos", "Lurigancho", "Lurín", "Magdalena del Mar", "Miraflores", "Pachacámac", "Pucusana", "Pueblo Libre", "Puente Piedra", "Punta Hermosa", "Punta Negra", "Rímac", "San Bartolo", "San Borja", "San Isidro", "San Juan de Lurigancho", "San Juan de Miraflores", "San Luis", "San Martín de Porres", "San Miguel", "Santa Anita", "Santa María del Mar", "Santa Rosa", "Santiago de Surco", "Surquillo", "Villa El Salvador", "Villa María del Triunfo");

?>

<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Marcriollo</title>
    <link rel="icon" href="Recursos/img/favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="Recursos/style/editar_usuario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                        <button type="button" class="btn btn-danger" onclick="window.location.href = 'usuario.php';">Cerrar</button>
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