<?php
// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Función para limpiar y validar datos
    function validarDatos($datos) {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    }

    // Validar y limpiar datos del formulario
    $nombre = validarDatos($_POST['from_name']);
    $telefono = validarDatos($_POST['phone_id']);
    $email = validarDatos($_POST['email_id']);
    $asunto = validarDatos($_POST['affair_id']);
    $mensaje = validarDatos($_POST['message']);

    // Validar que los campos no estén vacíos y que el correo electrónico tenga un formato válido
    if (empty($nombre) || empty($telefono) || empty($email) || empty($asunto) || empty($mensaje)) {
        echo "Por favor, completa todos los campos del formulario.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico ingresado no es válido.";
    } else {
        // Enviar correo electrónico
        $to = "jhordycontreras08@gmail.com"; 
        $subject = "Nuevo mensaje desde el formulario de contacto";
        $message = "Nombre: $nombre\n";
        $message .= "Teléfono: $telefono\n";
        $message .= "Correo electrónico: $email\n";
        $message .= "Asunto: $asunto\n";
        $message .= "Mensaje:\n$mensaje\n";

        // Envía el correo electrónico
        if (mail($to, $subject, $message)) {
            echo "¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.";
        } else {
            echo "Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.";
        }
    }
} else {
    // Si no es una solicitud POST, redirige a la página de contacto
    header("Location: contacto.html");
    exit();
}
?>