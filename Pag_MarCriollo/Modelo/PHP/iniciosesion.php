<?php

session_start();

include '../../Controlador/BD/Conexion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['password'];

$conexion = new Conexion();
$con = $conexion->getcon();

$query = "SELECT * FROM usuarios WHERE correo = :correo AND contrasena = :contrasena";
$stmt = $con->prepare($query);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':contrasena', $contrasena);
$stmt->execute();

if($stmt->rowCount() > 0) {
    $_SESSION['usuario'] = $correo;
    header("location: ../../menuprincipal.php");
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
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

?>
