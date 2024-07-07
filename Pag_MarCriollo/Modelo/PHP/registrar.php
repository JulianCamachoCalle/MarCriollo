<?php
// Incluye la clase de conexión
include '../../Controlador/BD/Conexion.php';

// Obtén la conexión
$conexion = new Conexion();
$con = $conexion->getcon();

// Captura los datos del formulario
$nombre = $_POST['nombres'];
$direccion = $_POST['direccion'];
$distrito = $_POST['distritos'];
$correo = $_POST['correo'];
$contrasena = $_POST['password'];
$contrasena2 = $_POST['password2'];

// Verifica que todos los campos estén llenos
if (empty($nombre) || empty($direccion) || empty($distrito) || empty($correo) || empty($contrasena) || empty($contrasena2)) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Por favor, rellene todos los campos!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

// Verifica que las contraseñas coincidan
if ($contrasena != $contrasena2) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Las contraseñas no coinciden, por favor verifique!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

// Verifica si el correo ya está en uso
$stmt = $con->prepare("SELECT * FROM usuarios WHERE correo = :correo");
$stmt->bindParam(':correo', $correo);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Este Correo ya esta en uso, pruebe con uno diferente!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

// Verifica si el nombre ya está en uso
$stmt = $con->prepare("SELECT * FROM usuarios WHERE nombres = :nombre");
$stmt->bindParam(':nombre', $nombre);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Este Usuario ya esta en uso, pruebe con uno diferente!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
    exit();
}

// Inserta el nuevo usuario
$query = "INSERT INTO usuarios (nombres, direccion, distrito, correo, contrasena) VALUES (:nombre, :direccion, :distrito, :correo, :contrasena)";
$stmt = $con->prepare($query);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':direccion', $direccion);
$stmt->bindParam(':distrito', $distrito);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':contrasena', $contrasena);

if ($stmt->execute()) {
    echo "<body>";
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Registro Exitoso!',
            text: 'Bienvenido a MarCriollo',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Ocurrio un error en el registro!',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Aceptar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = '../../intranet.php';
            }
        });
        </script>
        </body>";
}
