<?php

header('Content-Type: application/json');

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/DAO/DFacturas.php';
require_once '../Modelo/Facturas.php'; // Asegúrate de ajustar el nombre del modelo si es necesario

// Instancia del DAO de Facturas
$dFacturas = new DFacturas();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        switch ($tipo) {
            case 'list':
                $bus = isset($_GET['txtbus']) ? $_GET['txtbus'] : '';
                $dFacturas->getList($bus);
                echo json_encode($dFacturas->getArray());
                break;
            case 'get':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $factura = $dFacturas->getFacturaById($id);
                    if ($factura) {
                        echo json_encode($factura);
                    } else {
                        echo json_encode(['error' => 'Factura no encontrada']);
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
                $RUC = $_POST['RUC'];
                $razon_social = $_POST['razon_social'];
                $direccion_fiscal = $_POST['direccion_fiscal'];
                $fecha_emision = $_POST['fecha_emision'];
                $pago_final = $_POST['pago_final'];

                $dFacturas->insertFactura($nombre, $RUC, $razon_social, $direccion_fiscal, $fecha_emision, $pago_final);
                echo json_encode(['success' => true]);
                break;
            case 'edit':
                $id = $_POST['edit_id'];
                $nombre = $_POST['edit_nombre'];
                $RUC = $_POST['edit_RUC'];
                $razon_social = $_POST['edit_razon_social'];
                $direccion_fiscal = $_POST['edit_direccion_fiscal'];
                $fecha_emision = $_POST['edit_fecha_emision'];
                $pago_final = $_POST['edit_pago_final'];

                $dFacturas->updateFactura($id, $nombre, $RUC, $razon_social, $direccion_fiscal, $fecha_emision, $pago_final);
                echo json_encode(['success' => true]);
                break;
            case 'delete':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $dFacturas->deleteFactura($id);
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
