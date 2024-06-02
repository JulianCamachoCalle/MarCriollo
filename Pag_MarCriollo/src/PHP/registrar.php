<?php

include 'conexion.php';

$nombre = $_POST['nombres'];
$direccion = $_POST['direccion'];
$distrito = $_POST['distritos'];
$correo = $_POST['correo'];
$contrasena = $_POST['password'];
$contrasena = hash('sha512', $contrasena);

$query = "INSERT INTO usuarios(nombres, direccion, distrito, correo, contrasena) VALUES('$nombre','$direccion','$distrito','$correo','$contrasena')";

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
        <script>
            alert("Este Correo ya esta en uso, pruebe con uno diferente");
            window.location = "../intranet.php";
        </script>
    ';
    exit();
}

$verificar_nombres = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombres = '$nombre' ");

if (mysqli_num_rows($verificar_nombres) > 0) {
    echo '
        <script>
            alert("Este Usuario ya esta en uso, pruebe con uno diferente");
            window.location = "../intranet.php";
        </script>
    ';
    exit();
}

$ejecutar = mysqli_query($conexion, $query);

?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">