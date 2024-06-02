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
    echo '
        <script>
            alert("Usuario no existe, por favor verifique los datos introducidos");
            window.location = "../intranet.php";
        </script>
    ';
    exit();
}

?>