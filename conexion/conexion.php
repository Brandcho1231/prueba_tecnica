<?php

class Conexion
{
    private $servidor = 'localhost';
    private $baseDeDatos = 'prueba_tecnica';
    private $usuario = 'root';
    private $password = '';

    function __construct()
    {
      $this->conexion();
    }

    public function conexion()
    {
        try {
            $conexion = new PDO("mysql:host=$this->servidor;dbname=$this->baseDeDatos", $this->usuario, $this->password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Conexión realizada Satisfactoriamente';
            return $conexion;
        } catch (PDOException $e) {
            echo 'La conexión ha fallado: ' . $e->getMessage();
        }
        $conexion = null;
    }
}
?>
