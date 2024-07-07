<?php

require_once '../BD/Conexion.php';

class DUsuarios
{
    private $data;

    public function getArray()
    {
        return $this->data;
    }

    public function getsize()
    {
        return count($this->data);
    }

    public function getItem()
    {
        // Implementar este método según sea necesario
    }

    public function getList($bus)
    {
        try {
            $con = new Conexion();
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_USUARIOS()");
            $pre->execute();

            // Limpiar datos anteriores si es necesario
            $this->data = [];

            // Recorrer los resultados del procedimiento almacenado
            while ($fila = $pre->fetch(PDO::FETCH_ASSOC)) {
                $usuario = array(
                    "id" => $fila['id'],
                    "nombres" => $fila['nombres'],
                    "direccion" => $fila['direccion'],
                    "distrito" => $fila['distrito'],
                    "correo" => $fila['correo'],
                );
                $this->data[] = $usuario;
            }

            // Cerrar el cursor
            $pre->closeCursor();
        } catch (PDOException $e) {
            echo "Error al obtener la lista de usuarios: " . $e->getMessage();
        }
    }
}
