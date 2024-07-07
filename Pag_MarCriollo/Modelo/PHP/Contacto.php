<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["from_name"];
    $correo = $_POST["email_id"];
    $telefono = $_POST["phone_id"];
    $asunto = $_POST["affair_id"];
    $mensaje = $_POST["message"];

    $destinatario = "jhordycontreras08@gmail.com";
    $asuntoCorreo = "Nuevo mensaje de contacto";
    $mensajeCorreo = "Nombre: " . $nombre . "\r\n";
    $mensajeCorreo .= "Correo electrónico: " . $correo . "\r\n";
    $mensajeCorreo .= "Teléfono: " . $telefono . "\r\n";
    $mensajeCorreo .= "Asunto: " . $asunto . "\r\n";
    $mensajeCorreo .= "Mensaje: " . $mensaje . "\r\n";

    // Enviar el correo electrónico
    mail($destinatario, $asuntoCorreo, $mensajeCorreo);

    // Una vez que el formulario se ha procesado correctamente saldrá la alerta de que se envió
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>';
    echo 'Swal.fire({';
    echo '  title: "¡Excelente!",';
    echo '  text: "¡Has enviado el mensaje correctamente!",';
    echo '  icon: "success"';
    echo '});';
    echo '</script>';
}
?>