<?php
// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar datos del formulario
    // Validar campos

    // Enviar correo electrónico
    $to = "jhordycontreras08@gmail.com"; 
    $subject = "Nuevo mensaje desde el formulario de contacto";
    $message = "Nombre: " . $_POST['from_name'] . "\n";
    $message .= "Teléfono: " . $_POST['phone_id'] . "\n";
    $message .= "Correo electrónico: " . $_POST['email_id'] . "\n";
    $message .= "Asunto: " . $_POST['affair_id'] . "\n";
    $message .= "Mensaje:\n" . $_POST['message'] . "\n";

    // Envía el correo electrónico
    if (mail($to, $subject, $message)) {
        echo "¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.";
    } else {
        echo "Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.";
    }
} else {
    // Si no es una solicitud POST, redirige a la página de contacto
    header("Location: contacto.html");
    exit();
}
?>