<?php

session_start();

include 'conexion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['password'];

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena='$contrasena' ");

if(mysqli_num_rows($validar_login) > 0) {
    $_SESSION['usuario'] = $correo;
    header("location: ../menuprincipal.php");
    exit();
} else {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Usuario no existe, por favor verifique los datos introducidos',
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

?>