<?php

class DBoletas
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
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_BOLETAS(?)");
            $pre->bindParam(1, $bus, PDO::PARAM_STR);
            $pre->execute();
            $this->data = []; // Inicializa el array de datos para evitar acumulación de datos

            foreach ($pre as $fila) {
                $this->data[] = array(
                    "id" => $fila['id'],
                    "nombre" => $fila['nombre'],
                    "dni" => $fila['dni'],
                    "numero_de_cuotas" => $fila['numero_de_cuotas'],
                    "fecha_emision" => $fila['fecha_emision'],
                    "pago_final" => $fila['pago_final']
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

    public function insertBoleta($nombre, $dni, $numero_de_cuotas, $fecha_emision, $pago_final)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_INSERTAR_BOLETA(?, ?, ?, ?, ?)");
            $pre->bindParam(1, $nombre, PDO::PARAM_STR);
            $pre->bindParam(2, $dni, PDO::PARAM_STR);
            $pre->bindParam(3, $numero_de_cuotas, PDO::PARAM_INT);
            $pre->bindParam(4, $fecha_emision, PDO::PARAM_STR);
            $pre->bindParam(5, $pago_final, PDO::PARAM_STR);
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

    public function updateBoleta($id, $nombre, $dni, $numero_de_cuotas, $fecha_emision, $pago_final)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ACTUALIZAR_BOLETA(?, ?, ?, ?, ?, ?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->bindParam(2, $nombre, PDO::PARAM_STR);
            $pre->bindParam(3, $dni, PDO::PARAM_STR);
            $pre->bindParam(4, $numero_de_cuotas, PDO::PARAM_INT);
            $pre->bindParam(5, $fecha_emision, PDO::PARAM_STR);
            $pre->bindParam(6, $pago_final, PDO::PARAM_STR);
            $pre->execute();
            $pre->closeCursor();
        } catch (PDOException $e) {
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        return true;
    }

    public function deleteBoleta($id)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ELIMINAR_BOLETA(?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->execute();
            $pre->closeCursor();
        } catch (PDOException $e) {
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return false;
        }

        return true;
    }

    public function getBoletaById($id)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_BOLETA_POR_ID(?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->execute();

            $boleta = $pre->fetch(PDO::FETCH_ASSOC);
            $pre->closeCursor();

            if ($boleta) {
                return $boleta;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo "Error al ejecutar procedimiento almacenado: " . $e->getMessage();
            return null;
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
            return null;
        }
    }
}

?>
