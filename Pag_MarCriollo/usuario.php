<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Marcriollo</title>
    <link rel="icon" href="Recursos/img/favicon-32x32.png" type="image/png">
    <script src="https://kit.fontawesome.com/d2b7381cec.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Recursos/style/usuario.css">
</head>

<body>
    <?php
    session_start();
    include "Controlador/BD/Conexion.php";

    // Eliminar usuario
    if (isset($_POST['eliminar_id'])) {
        try {
            $eliminar_id = $_POST['eliminar_id'];

            // Establecer la conexión
            $conexion = new Conexion();
            $con = $conexion->getcon();

            // Preparar la consulta para eliminar usuario
            $eliminar_query = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $con->prepare($eliminar_query);
            $stmt->bindParam(':id', $eliminar_id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se eliminó correctamente
            if ($stmt->rowCount() > 0) {
                mostrarAlerta('success', 'Usuario Eliminado!', 'El usuario ha sido eliminado exitosamente');
            } else {
                mostrarAlerta('error', 'Error al eliminar', 'No se encontró el usuario o ocurrió un error');
            }
        } catch (PDOException $e) {
            echo "Error al eliminar usuario: " . $e->getMessage();
        }
    }

    // Consultar usuarios
    try {
        // Establecer la conexión
        $conexion = new Conexion();
        $con = $conexion->getcon();

        // Preparar y ejecutar la consulta SQL
        $sql = "SELECT id, nombres, direccion, distrito, correo FROM usuarios";
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $lista = [];
        if ($stmt->rowCount() > 0) {
            $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "<tr><td colspan='7'>No se encontraron resultados</td></tr>";
        }

        $_SESSION["dato"] = $lista;
    } catch (PDOException $e) {
        echo "Error al consultar usuarios: " . $e->getMessage();
    }

    function mostrarAlerta($icono, $titulo, $texto)
    {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
        echo "<script>
        Swal.fire({
            icon: '$icono',
            title: '$titulo',
            text: '$texto',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'usuario.php';
            }
        });
        </script>";
        exit;
    }
    ?>

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
        <div class="container">
            <form method="POST" action="">
                <div class="elementos-accionar">
                    <div class="agregar_usuarios">
                        <button type="button" onclick="window.location.href='agregar_usuarios.php'" class="btnagregar">
                            <i class="fa-solid fa-circle-plus"></i>
                            Agregar
                        </button>
                    </div>
                    <div class="input-group">
                        <input type="text" name="textn" id="textn">
                        <button class="btnbuscar" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="mostrar-todos">
                        <button type="submit" name="show_all" value="true" class="btnmostrar">
                            <i class="fa-solid fa-eye"></i>
                            Mostrar Todos
                        </button>
                    </div>
                    <?php
                    if (isset($_POST['show_all']) && $_POST['show_all'] == 'true') {
                        $txtn = count($lista); // Mostrar todos los elementos si se solicita explícitamente
                    } else {
                        if (empty($_POST["textn"])) {
                            $txtn = count($lista); // Mostrar todos si no se proporciona un valor específico
                        } else {
                            $txtn = $_POST["textn"]; // Mostrar la cantidad especificada por el usuario
                        }
                    }

                    // Limitar $f al tamaño máximo de $lista para evitar índices fuera de rango
                    $f = ($txtn <= count($lista) ? $txtn : count($lista));
                    ?>

                    <input type="hidden" name="txtn" value="<?php echo $txtn; ?>">

                </div>
            </form>

            <div class="tabla-usuarios-registrados">
                <form method="POST" action="">
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
                        <tbody>
                            <?php
                            $i = 0;
                            do {
                                echo "
        <tr>
            <td>
                <input type='checkbox' name='chk$i' value='" . $lista[$i]['id'] . "'>
            </td>
            <td>" . $lista[$i]['id'] . "</td>
            <td>" . $lista[$i]['nombres'] . "</td>
            <td>" . $lista[$i]['direccion'] . "</td>
            <td>" . $lista[$i]['distrito'] . "</td>
            <td>" . $lista[$i]['correo'] . "</td>
            <td>
                <div class='botones'>
                    <button type='button' class='btneditaricon'><a href='editar_usuario.php?id=" . $lista[$i]['id'] . "'><i class='fa-solid fa-pen-to-square'></i></a></button>
                    <form method='POST' action=''>
                        <input type='hidden' name='eliminar_id' value='" . $lista[$i]['id'] . "'>
                        <button type='submit' name='eliminar' class='btneliminaricon'><i class='fa-solid fa-trash'></i></button>
                    </form>
                </div>
            </td>
        </tr>";
                                $i++;
                            } while ($i < count($lista));
                            ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>
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