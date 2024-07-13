<?php

header('Content-Type: application/json');

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/DAO/DBoletas.php';
require_once '../Modelo/Boletas.php'; 

// Instancia del DAO de Boletas
$dBoletas = new DBoletas();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        switch ($tipo) {
            case 'list':
                $bus = isset($_GET['txtbus']) ? $_GET['txtbus'] : '';
                $dBoletas->getList($bus);
                echo json_encode($dBoletas->getArray());
                break;
            case 'get':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $boleta = $dBoletas->getBoletaById($id);
                    if ($boleta) {
                        echo json_encode($boleta);
                    } else {
                        echo json_encode(['error' => 'Boleta no encontrada']);
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
                $nombre = $_POST['nombre'];
                $dni = $_POST['dni'];
                $numero_de_cuotas = $_POST['numero_de_cuotas'];
                $fecha_emision = $_POST['fecha_emision'];
                $pago_final = $_POST['pago_final'];

                $dBoletas->insertBoleta($nombre, $dni, $numero_de_cuotas, $fecha_emision, $pago_final);
                echo json_encode(['success' => true]);
                break;
            case 'edit':
                $id = $_POST['edit_id'];
                $nombre = $_POST['edit_nombre'];
                $dni = $_POST['edit_dni'];
                $numero_de_cuotas = $_POST['edit_numero_de_cuotas'];
                $fecha_emision = $_POST['edit_fecha_emision'];
                $pago_final = $_POST['edit_pago_final'];

                $dBoletas->updateBoleta($id, $nombre, $dni, $numero_de_cuotas, $fecha_emision, $pago_final);
                echo json_encode(['success' => true]);
                break;
                
            case 'delete':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $dBoletas->deleteBoleta($id);
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
?>
