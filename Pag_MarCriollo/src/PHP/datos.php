<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $correo = $_SESSION['usuario'];
    include 'PHP/conexion.php';
    // Consulta a la base de datos para obtener los datos del usuario
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
    $datos_usuario = mysqli_fetch_assoc($consulta);

    // Mostrar los datos del usuario
    echo '<div>';
    echo 'Nombres Y Apellidos: ' . $datos_usuario['nombres'] . '<br>';
    echo 'Correo electrónico: ' . $datos_usuario['correo'] . '<br>';
    echo 'Direccion: ' . $datos_usuario['direccion'] . '<br>';
    echo 'Distrito: ' . $datos_usuario['distrito'] . '<br>';
    echo '</div>';
}
