<?php

try {
    require_once '/../BD/Conexion.php';
} catch (Exception $e) {
    echo 'Error cargando Conexion.php: ' . $e->getMessage();
    exit;
}

require_once '../Controlador/Dao/DUsuarios.php';
require_once '../Modelo/Usuarios.php';

// Instanciamos el DAO de Usuarios
$ddist = new DUsuarios();

// Obtenemos el parámetro de búsqueda (si existe)
$bus = isset($_REQUEST["txtbus"]) ? $_REQUEST["txtbus"] : "";

// Llamamos al método del DAO para obtener la lista de usuarios
$ddist->getList($bus);

// Obtenemos los datos como un arreglo asociativo
$usuariosArray = $ddist->getArray();

// Devolvemos la respuesta en formato JSON
echo json_encode($usuariosArray);
