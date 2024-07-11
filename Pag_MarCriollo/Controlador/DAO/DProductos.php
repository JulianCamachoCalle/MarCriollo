<?php

require_once '../Controlador/BD/Conexion.php';

class DProductos
{
    private $data;

    public function getArray()
    {
        return $this->data;
    }

    public function getList($bus)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_PRODUCTOS(?)");
            $pre->bindParam(1, $bus, PDO::PARAM_STR);
            $pre->execute();
            $this->data = []; // Inicializa el array de datos para evitar acumulación de datos entre llamadas

            foreach ($pre as $fila) {
                $this->data[] = array(
                    "id" => $fila['id'],
                    "nombre" => $fila['producto'],
                    "descripcion" => $fila['detalles'],
                    "precio" => $fila['precio'],
                    "imagen" => $fila['foto']
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

    public function insertProducto($nombre, $descripcion, $precio, $imagen)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_INSERTAR_PRODUCTO(?, ?, ?, ?)");
            $pre->bindParam(1, $nombre, PDO::PARAM_STR);
            $pre->bindParam(2, $descripcion, PDO::PARAM_STR);
            $pre->bindParam(3, $precio, PDO::PARAM_INT);
            $pre->bindParam(4, $imagen, PDO::PARAM_STR);
            $pre->execute();
            $pre->closeCursor();
        } catch (PDOException $e) {
            // Manejo del error de PDO (error de base de datos)
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            // Puedes agregar más detalles sobre el error o registrarlos en un archivo de registro
            return false; // Devuelve false para indicar que hubo un error
        } catch (Exception $e) {
            // Manejo de otros tipos de excepciones
            echo "Ocurrió un error: " . $e->getMessage();
            return false; // Devuelve false para indicar que hubo un error
        }
    
        return true; // Retorna true si la inserción fue exitosa
    }

    public function updateProducto($id, $nombre, $descripcion, $precio)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ACTUALIZAR_PRODUCTO(?, ?, ?, ?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->bindParam(2, $nombre, PDO::PARAM_STR);
            $pre->bindParam(3, $descripcion, PDO::PARAM_STR);
            $pre->bindParam(4, $precio, PDO::PARAM_INT);
            $pre->execute();
            $pre->closeCursor();
        } catch (PDOException $e) {
            // Manejo del error de PDO (error de base de datos)
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            // Puedes agregar más detalles sobre el error o registrarlos en un archivo de registro
            return false; // Devuelve false para indicar que hubo un error
        } catch (Exception $e) {
            // Manejo de otros tipos de excepciones
            echo "Ocurrió un error: " . $e->getMessage();
            return false; // Devuelve false para indicar que hubo un error
        }
    
        return true; // Retorna true si la actualización fue exitosa
    }

    public function updateProductoConImagen($id, $nombre, $descripcion, $precio, $imagen)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ACTUALIZAR_PRODUCTO_CON_IMAGEN(?, ?, ?, ?, ?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->bindParam(2, $nombre, PDO::PARAM_STR);
            $pre->bindParam(3, $descripcion, PDO::PARAM_STR);
            $pre->bindParam(4, $precio, PDO::PARAM_INT);
            $pre->bindParam(5, $imagen, PDO::PARAM_STR);
            $pre->execute();
            $pre->closeCursor();
        } catch (PDOException $e) {
            // Manejo del error de PDO (error de base de datos)
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            // Puedes agregar más detalles sobre el error o registrarlos en un archivo de registro
            return false; // Devuelve false para indicar que hubo un error
        } catch (Exception $e) {
            // Manejo de otros tipos de excepciones
            echo "Ocurrió un error: " . $e->getMessage();
            return false; // Devuelve false para indicar que hubo un error
        }
    
        return true; // Retorna true si la actualización fue exitosa
    }

    public function deleteProducto($id)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ELIMINAR_PRODUCTO(?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->execute();
            $pre->closeCursor();
        } catch (PDOException $e) {
            // Manejo del error de PDO (error de base de datos)
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            // Puedes agregar más detalles sobre el error o registrarlos en un archivo de registro
            return false; // Devuelve false para indicar que hubo un error
        } catch (Exception $e) {
            // Manejo de otros tipos de excepciones
            echo "Ocurrió un error: " . $e->getMessage();
            return false; // Devuelve false para indicar que hubo un error
        }
    
        return true; // Retorna true si la eliminación fue exitosa
    }

    public function getProductoById($id)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_PRODUCTO_POR_ID(?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->execute();
            $producto = $pre->fetch(PDO::FETCH_ASSOC);
            $pre->closeCursor();
            return $producto;
        } catch (PDOException $e) {
            // Manejo del error de PDO (error de base de datos)
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            // Puedes agregar más detalles sobre el error o registrarlos en un archivo de registro
            return null; // Devuelve null para indicar que hubo un error
        } catch (Exception $e) {
            // Manejo de otros tipos de excepciones
            echo "Ocurrió un error: " . $e->getMessage();
            return null; // Devuelve null para indicar que hubo un error
        }
    }
}

?>