<!DOCTYPE html>
<html lang="es">
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarCriollo</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style/usuario.css" !important>
    <script src="https://kit.fontawesome.com/d2b7381cec.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    session_start();

    include "PHP/conexion.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $direccion = $_POST['direccion'];
        $distrito = $_POST['distrito'];
        $correo = $_POST['correo'];

        $query = "INSERT INTO usuarios (id, nombres, direccion, distrito, correo) VALUES ('$id', '$nombres', '$direccion', '$distrito', '$correo')";
        mysqli_query($conexion, $query);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_users'])) {
        foreach ($_POST['chk'] as $id) {
            $query = "DELETE FROM usuarios WHERE id='$id'";
            mysqli_query($conexion, $query);
        }
    }

    $datos = mysqli_query($conexion, "SELECT id, nombres, direccion, distrito, correo FROM usuarios");

    if (!$datos) {
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
        echo "0 results";
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
            <div class="elementos-accionar">
                <div class="eliminar_usuarios">
                    <button type="submit" name="eliminar_usuarios" class="btneliminar">
                        <i class="fa-solid fa-trash"></i>
                        Eliminar
                    </button>
                </div>
                <div class="agregar_usuarios">
                    <button type="submit" name="agregar_usuarios" class="btnagregar">
                        <i class="fa-solid fa-circle-plus"></i>
                        Agregar
                    </button>
                </div>
                <form method="GET" class="form_busqueda" action="buscar_usuario.php">
                    <input type="text" class="inputeliminar" id="" placeholder=" Ingrese el nombre o ID del usuario">
                    <div class="busqueda_usuario">
                        <button type="submit" class="btnbuscar">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

            <form method="POST" action="">
                <div class="tabla-usuarios-registrados mt-5">
                    <table class="table table-striped">
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
                            $lista = $_SESSION["dato"];
                            $i = 0;

                            foreach ($lista as $item) {
                                echo "
                                <tr>
                                    <td>
                                        <input type='checkbox' name='chk[]' value='" . $item['id'] . "'>
                                    </td>
                                    <td>" . $item['id'] . "</td>
                                    <td>" . $item['nom'] . "</td>
                                    <td>" . $item['dir'] . "</td>
                                    <td>" . $item['dis'] . "</td>
                                    <td>" . $item['cor'] . "</td>
                                    <td>
                                        <button type='button' class='btneditaricon'><i class='fa-solid fa-pen-to-square'></i></button>
                                        <button type='button' class='btneliminaricon'><i class='fa-solid fa-trash'></i></button>
                                    </td>
                                </tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
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