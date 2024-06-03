<?php
// Aquí se incluye la biblioteca SweetAlert2
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar los datos del formulario (aquí iría tu código para procesar el formulario)
    
    // Una vez procesado el formulario con éxito, mostramos el mensaje de éxito con SweetAlert2
    echo '<script>';
    echo 'Swal.fire({';
    echo '    title: "¡Bien hecho!",';
    echo '    text: "¡El mensaje ha sido enviado correctamente!",';
    echo '    icon: "success"';
    echo '});';
    echo '</script>';
}
?>