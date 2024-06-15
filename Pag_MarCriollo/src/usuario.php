<?php
session_start();
include "PHP/conexion.php";

// Eliminar usuario si se ha enviado el formulario de eliminación
if (isset($_POST['eliminar_id'])) {
    $eliminar_id = $_POST['eliminar_id'];
    $eliminar_query = "DELETE FROM usuarios WHERE id = $eliminar_id";
    $resultado = mysqli_query($conexion, $eliminar_query);
    if ($resultado) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario Eliminado!',
                    text: 'El usuario ha sido eliminado exitosamente',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'usuario.php';
                    }
                });
              </script>";
        exit;
    } else {
        die("Error al eliminar: " . mysqli_error($conexion));
    }
}

// Búsqueda de usuarios
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    $query = mysqli_real_escape_string($conexion, $query);
    $sql = "SELECT id, nombres, direccion, distrito, correo FROM usuarios WHERE nombres LIKE '%$query%' OR id LIKE '%$query%'";
} else {
    $sql = "SELECT id, nombres, direccion, distrito, correo FROM usuarios";
}

if (!$datos = mysqli_query($conexion, $sql)) {
    die("Query failed: " . mysqli_error($conexion));
}

$lista = [];
if (mysqli_num_rows($datos) > 0) {
    while ($row = mysqli_fetch_assoc($datos)) {
        $lista[] = array(
            'id' => $row["id"],
            'nom' => $row["nombres"],
            'dir' => $row["direccion"],
            'dis' => $row["distrito"],
            'cor' => $row["correo"]
        );
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron resultados</td></tr>";
}

?>
<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    <script src="https://kit.fontawesome.com/d2b7381cec.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/usuarios.css">
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
        <div class="container">
            <form method="POST" action="">
                <div class="elementos-accionar">
                    <button type="submit" name="eliminar_usuarios" class="btneliminar">
                        <i class="fa-solid fa-trash"></i>
                        Eliminar
                    </button>
                    <div class="agregar_usuarios">
                        <button type="button" onclick="window.location.href='agregar_usuarios.php'" class="btnagregar">
                            <i class="fa-solid fa-circle-plus"></i>
                            Agregar
                        </button>
                    </div>
                    <form method="GET" class="form_busqueda" action="">
                        <div class="input-group">
                            <input type="text" class="inputbuscar" name="query" placeholder=" Ingrese el nombre o ID del usuario">
                            <button type="submit" class="btnbuscar">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="tabla-usuarios-registrados">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Código</th>
                                <th scope="col">Nombres y Apellidos</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Distrito</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <?php foreach ($lista as $item) { ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="chk[]" value="<?php echo $item['id']; ?>">
                                </td>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nom']; ?></td>
                                <td><?php echo $item['dir']; ?></td>
                                <td><?php echo $item['dis']; ?></td>
                                <td><?php echo $item['cor']; ?></td>
                                <td>
                                    <div class="botones">
                                        <a href="editar_usuario.php?id=<?php echo $item['id']; ?>" class="btneditaricon">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="" method="post">
                                            <input type="hidden" name="eliminar_id" value="<?php echo $item['id']; ?>">
                                            <button type="submit" name="eliminar" class="btneliminaricon">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </form>
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