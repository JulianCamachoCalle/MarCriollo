<?php

if (empty($_POST["registro"])) {
    if (empty($_POST["nombres"]) or empty($_POST["nombres"]) or empty($_POST["direccion"]) or empty($_POST["distritos"]) or empty($_POST["correo"]) or empty($_POST["password"]) or empty($_POST["password2"])) {
        echo 'Complete todos los campos';
    } else {

    }
}

?>