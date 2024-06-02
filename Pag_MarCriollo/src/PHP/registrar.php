<?php

include 'conexion.php';

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
                window.location = '../intranet.php';
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
                window.location = '../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

$query = "INSERT INTO usuarios(nombres, direccion, distrito, correo, contrasena) VALUES('$nombre','$direccion','$distrito','$correo','$contrasena')";

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Este Correo ya esta en uso, pruebe con uno diferente!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

$verificar_nombres = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombres = '$nombre' ");

if (mysqli_num_rows($verificar_nombres) > 0) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Este Usuario ya esta en uso, pruebe con uno diferente!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Registro Exitoso!',
            text: 'Bienvenido a MarCriollo',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../intranet.php';
            }
        });
        </script>
        </body>";
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ocurrio un error en el registro!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../intranet.php';
            }
        });
        </script>
        </body>";
}


?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">