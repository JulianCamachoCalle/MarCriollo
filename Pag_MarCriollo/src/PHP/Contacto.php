<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["from_name"];
    $correo = $_POST["email_id"];

    $destinatario = "jhordycontreras08@gmail.com";
    $asunto = "Nuevo mensaje de contacto";
    $mensaje = "Nombre: " . $nombre . "\r\n";
    $mensaje .= "Correo electrónico: " . $correo . "\r\n";


    // Enviar el correo electrónico
    mail($destinatario, $asunto, $mensaje);

     // Una vez que el formulario se ha procesado correctamente saldra la alerta que se envio
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