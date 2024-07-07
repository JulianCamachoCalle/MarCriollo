<?php
class Conexion
{
    private $local = "bv7xx9bbke21yomtrc0m-mysql.services.clever-cloud.com";
    private $usu = "uu57wycwjgena4uo";
    private $pas = "tvX7fUiY8xKHp0zVuOMx";
    private $bd = "bv7xx9bbke21yomtrc0m";
    private $port = "3306";

    public function getcon()
    {
        $con = new PDO(
            "mysql:host=" . $this->local . ";" .
                "dbname=" . $this->bd . ";" .
                "port=" . $this->port,
            $this->usu,
            $this->pas,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
        );
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    }
}
