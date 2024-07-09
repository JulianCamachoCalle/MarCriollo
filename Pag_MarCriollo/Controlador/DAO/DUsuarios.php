<?php

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
        // Método placeholder para obtener un ítem específico
    }


    public function getList($bus)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_USUARIOS(?)");
            $pre->bindParam(1, $bus, PDO::PARAM_STR);
            $pre->execute();
            $this->data = []; // Inicializa el array de datos para evitar acumulación de datos

            foreach ($pre as $fila) {
                $this->data[] = array(
                    "id" => $fila['id'],
                    "nombres" => $fila['nombres'],
                    "direccion" => $fila['direccion'],
                    "distrito" => $fila['distrito'],
                    "correo" => $fila['correo']
                );
            }
            $pre->closeCursor(); // Cierra el cursor
        } catch (PDOException $e) {
            // Manejar el error de conexión a la base de datos
            echo "Error al obtener los datos: " . $e->getMessage();
        } catch (Exception $e) {
            // Manejar otros tipos de errores
            echo "Ocurrió un error: " . $e->getMessage();
        }
    }

    public function insertUsuario($nombres, $direccion, $distrito, $correo, $contrasena)
    {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL InsertarUsuario(?, ?, ?, ?, ?)");
        $pre->bindParam(1, $nombres, PDO::PARAM_STR);
        $pre->bindParam(2, $direccion, PDO::PARAM_STR);
        $pre->bindParam(3, $distrito, PDO::PARAM_STR);
        $pre->bindParam(4, $correo, PDO::PARAM_STR);
        $pre->bindParam(5, $contrasena, PDO::PARAM_STR);
        $pre->execute();
        $pre->closeCursor(); // Cerrar el cursor
    }

    public function updateUsuario($id, $nombres, $direccion, $distrito, $correo, $contrasena)
    {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL ActualizarUsuario(?, ?, ?, ?, ?, ?)");
        $pre->bindParam(1, $id, PDO::PARAM_INT);
        $pre->bindParam(2, $nombres, PDO::PARAM_STR);
        $pre->bindParam(3, $direccion, PDO::PARAM_STR);
        $pre->bindParam(4, $distrito, PDO::PARAM_STR);
        $pre->bindParam(5, $correo, PDO::PARAM_STR);
        if (empty($contrasena)) {
            // Si la contraseña está vacía, significa que no se ha modificado
            // Obtener la contraseña existente del usuario
            $usuario = $this->getUsuarioById($id);
            $contrasena = $usuario['contrasena'];
        }
        $pre->bindParam(6, $contrasena, PDO::PARAM_STR);
        $pre->execute();
        $pre->closeCursor(); // Cerrar el cursor
    }

    public function deleteUsuario($id)
    {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL EliminarUsuario(?)");
        $pre->bindParam(1, $id, PDO::PARAM_INT);
        $pre->execute();
        $pre->closeCursor(); // Cerrar el cursor
    }

    public function getUsuarioById($id)
    {
        $con = new Conexion();
        $pre = $con->getcon()->prepare("CALL ObtenerUsuarioPorId(?)");
        $pre->bindParam(1, $id, PDO::PARAM_INT);
        $pre->execute();

        $usuario = $pre->fetch(PDO::FETCH_ASSOC);
        $pre->closeCursor(); // Cerrar el cursor

        if ($usuario) {
            return $usuario;
        } else {
            return null;
        }
    }
}
