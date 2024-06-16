<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Marcriollo</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    <script src="https://kit.fontawesome.com/d2b7381cec.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/usuario.css">
</head>

<body>
    <?php
    session_start();
    include "PHP/conexion.php";

    //Eliminar
    if (isset($_POST['eliminar_id'])) {
        $eliminar_id = $_POST['eliminar_id'];
        $eliminar_query = "DELETE FROM usuarios WHERE id = '$eliminar_id'";
        $resultado = mysqli_query($conexion, $eliminar_query);
        if ($resultado) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Usuario Eliminado!',
            text: 'El usuario ha sido eliminado exitosamente',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar'
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

    $sql = "SELECT id, nombres, direccion, distrito, correo FROM usuarios";
    $datos = mysqli_query($conexion, $sql);

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

    $_SESSION["dato"] = $lista;
    ?>
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
                        $txtn = count($lista);
                    } else {
                        if (empty($_POST["textn"])) {
                            $txtn = count($lista);
                        } else {
                            $txtn = $_POST["textn"];
                        }
                    }
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
                            <td>" . $lista[$i]['nom'] . "</td>
                            <td>" . $lista[$i]['dir'] . "</td>
                            <td>" . $lista[$i]['dis'] . "</td>
                            <td>" . $lista[$i]['cor'] . "</td>
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
                            } while ($i < $f);
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