<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerta de Pedido - MarCriollo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        // Mostrar la alerta usando SweetAlert2
        Swal.fire({
            icon: 'success',
                title: '¡Entrega en camino!',
                text: 'Por favor, revise su correo electrónico para más detalles.',
                confirmButtonText: 'Aceptar'
        }).then((result) => {
            // Redirigir a la página de inicio después de hacer clic en 'Listo'
            if (result.isConfirmed || result.isDismissed) {
                window.location.href = 'http://localhost/MarCriollo12/Pag_MarCriollo/index.php';
            }
        });
    </script>
</body>
</html>