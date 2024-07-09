<?php

header('Content-Type: application/json');

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/DAO/DUsuarios.php';
require_once '../Modelo/Usuarios.php';

// Instancia del DAO de Usuarios
$dUsuarios = new DUsuarios();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        switch ($tipo) {
            case 'list':
                $bus = isset($_GET['txtbus']) ? $_GET['txtbus'] : '';
                $dUsuarios->getList($bus);
                echo json_encode($dUsuarios->getArray());
                break;
            case 'get':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $usuario = $dUsuarios->getUsuarioById($id);
                    if ($usuario) {
                        echo json_encode($usuario);
                    } else {
                        echo json_encode(['error' => 'Usuario no encontrado']);
                    }
                } else {
                    echo json_encode(['error' => 'ID no proporcionado']);
                }
                break;
            default:
                echo json_encode(['error' => 'Tipo de solicitud no reconocido']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Tipo de solicitud no proporcionado']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tipo'])) {
        $tipo = $_POST['tipo'];

        switch ($tipo) {
            case 'add':
                $nombres = $_POST['nombres'];
                $direccion = $_POST['direccion'];
                $distrito = $_POST['distrito'];
                $correo = $_POST['correo'];
                $contrasena = $_POST['contrasena'];

                $dUsuarios->insertUsuario($nombres, $direccion, $distrito, $correo, $contrasena);
                echo json_encode(['success' => true]);
                break;
            case 'edit':
                $id = $_POST['edit_id'];
                $nombres = $_POST['edit_nombres'];
                $direccion = $_POST['edit_direccion'];
                $distrito = $_POST['edit_distrito'];
                $correo = $_POST['edit_correo'];
                $contrasena = $_POST['edit_contrasena'];

                $dUsuarios->updateUsuario($id, $nombres, $direccion, $distrito, $correo, $contrasena);
                echo json_encode(['success' => true]);
                break;
            case 'delete':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $dUsuarios->deleteUsuario($id);
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['error' => 'ID no proporcionado']);
                }
                break;
            default:
                echo json_encode(['error' => 'Tipo de solicitud no reconocido']);
                break;
        }
    } else {
        echo json_encode(['error' => 'Tipo de solicitud no proporcionado']);
    }
} else {
    echo json_encode(['error' => 'Método no soportado']);
}
