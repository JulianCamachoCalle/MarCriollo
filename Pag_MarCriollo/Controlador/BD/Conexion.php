<?php
class Conexion
{
    private $local = "localhost";
    private $usu = "root";
    private $pas = "";
    private $bd = "bdmarcriollo";
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
