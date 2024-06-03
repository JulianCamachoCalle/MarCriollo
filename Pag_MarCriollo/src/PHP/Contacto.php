<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["from_name"];
    $correo = $_POST["email_id"];

    // Aquí puedes realizar las acciones necesarias, como enviar un correo electrónico
    // o guardar los datos en una base de datos

    // Por ejemplo, enviar un correo electrónico de confirmación
    $destinatario = "jhordycontreras08@gmail.com";
    $asunto = "Nuevo mensaje de contacto";
    $mensaje = "Nombre: " . $nombre . "\r\n";
    $mensaje .= "Correo electrónico: " . $correo . "\r\n";
    // Puedes agregar más campos según sea necesario

    // Enviar el correo electrónico
    mail($destinatario, $asunto, $mensaje);

    // Una vez que el formulario se ha procesado correctamente, puedes imprimir el script de SweetAlert2
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