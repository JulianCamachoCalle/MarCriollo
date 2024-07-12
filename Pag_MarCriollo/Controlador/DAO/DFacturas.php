<?php

class DFacturas
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
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_FACTURAS(?)");
            $pre->bindParam(1, $bus, PDO::PARAM_STR);
            $pre->execute();
            $this->data = [];

            foreach ($pre as $fila) {
                $this->data[] = array(
                    "id" => $fila['id'],
                    "nombre" => $fila['nombre'],
                    "RUC" => $fila['RUC'],
                    "razon_social" => $fila['razon_social'],
                    "direccion_fiscal" => $fila['direccion_fiscal'],
                    "fecha_emision" => $fila['fecha_emision'],
                    "pago_final" => $fila['pago_final']
                );
            }
            $pre->closeCursor();
        } catch (PDOException $e) {
            echo "Error al obtener los datos: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Ocurrió un error: " . $e->getMessage();
        }
    }

    public function insertFactura($nombre, $RUC, $razon_social, $direccion_fiscal, $fecha_emision, $pago_final)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_INSERTAR_FACTURA(?, ?, ?, ?, ?, ?)");
            $pre->bindParam(1, $nombre, PDO::PARAM_STR);
            $pre->bindParam(2, $RUC, PDO::PARAM_STR);
            $pre->bindParam(3, $razon_social, PDO::PARAM_STR);
            $pre->bindParam(4, $direccion_fiscal, PDO::PARAM_STR);
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

    public function updateFactura($id, $nombre, $RUC, $razon_social, $direccion_fiscal, $fecha_emision, $pago_final)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ACTUALIZAR_FACTURA(?, ?, ?, ?, ?, ?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->bindParam(2, $nombre, PDO::PARAM_STR);
            $pre->bindParam(3, $RUC, PDO::PARAM_STR);
            $pre->bindParam(4, $razon_social, PDO::PARAM_STR);
            $pre->bindParam(5, $direccion_fiscal, PDO::PARAM_STR);
            $pre->bindParam(6, $fecha_emision, PDO::PARAM_STR);
            $pre->bindParam(7, $pago_final, PDO::PARAM_STR);
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

    public function deleteFactura($id)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_ELIMINAR_FACTURA(?)");
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

    public function getFacturaById($id)
    {
        $con = new Conexion();
        try {
            $pre = $con->getcon()->prepare("CALL SP_OBTENER_FACTURA_POR_ID(?)");
            $pre->bindParam(1, $id, PDO::PARAM_INT);
            $pre->execute();

            $factura = $pre->fetch(PDO::FETCH_ASSOC);
            $pre->closeCursor();

            if ($factura) {
                return $factura;
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
