<?php

header('Content-Type: application/json');

require_once '../Controlador/BD/Conexion.php';
require_once '../Controlador/DAO/DProductos.php';
require_once '../Modelo/Productos.php';

// Instancia del DAO de Productos
$dProductos = new DProductos();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        switch ($tipo) {
            case 'list':
                $bus = isset($_GET['txtbus']) ? $_GET['txtbus'] : '';
                $dProductos->getList($bus);
                echo json_encode($dProductos->getArray());
                break;
            case 'get':
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto = $dProductos->getProductoById($id);
                    if ($producto) {
                        echo json_encode($producto);
                    } else {
                        echo json_encode(['error' => 'Producto no encontrado']);
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
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];

                // Manejo de la imagen si es necesario guardarla
                if (isset($_FILES['imagen'])) {
                    $imagen = $_FILES['imagen']['name'];
                    $imagen_tmp = $_FILES['imagen']['tmp_name'];
                    move_uploaded_file($imagen_tmp, '../imagenes/' . $imagen);
                } else {
                    $imagen = ''; // Opcional: asigna un valor por defecto si no se proporciona imagen
                }

                $dProductos->insertProducto($nombre, $descripcion, $precio, $imagen);
                echo json_encode(['success' => true]);
                break;
            case 'edit':
                $id = $_POST['edit_id'];
                $nombre = $_POST['edit_nombre'];
                $descripcion = $_POST['edit_descripcion'];
                $precio = $_POST['edit_precio'];

                // Manejo de la imagen si se desea actualizar
                if (isset($_FILES['edit_imagen']) && $_FILES['edit_imagen']['size'] > 0) {
                    $imagen = $_FILES['edit_imagen']['name'];
                    $imagen_tmp = $_FILES['edit_imagen']['tmp_name'];
                    move_uploaded_file($imagen_tmp, '../imagenes/' . $imagen);
                    $dProductos->updateProductoConImagen($id, $nombre, $descripcion, $precio, $imagen);
                } else {
                    $dProductos->updateProducto($id, $nombre, $descripcion, $precio);
                }

                echo json_encode(['success' => true]);
                break;

            case 'delete':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $dProductos->deleteProducto($id);
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