<?php
if (!empty($_POST["registro"])) {
    if (empty($_POST["nombres"]) or empty($_POST["direccion"]) or empty($_POST["distritos"]) or empty($_POST["correo"]) or empty($_POST["password"]) or empty($_POST["password2"])) {
        echo 'Complete todos los campos';
    } else {
        include("conexion.php");
        $nombre = $_POST["nombres"];
        $direccion = $_POST["direccion"];
        $distrito = $_POST["distritos"];
        $correo = $_POST["correo"];
        $password = $_POST["password"];
        $sql = $conexion -> query(" insert into usuarios(nombres, direccion, distritio, correo, password)values('$nombre','$direccion','$distrito','$correo','$password')");
        if ($sql == 1) {
            echo 'Usuario registrado correctamente';
        } else {
            echo 'Error al registrar intentelo nuevamente';
        }
    }
}

?>