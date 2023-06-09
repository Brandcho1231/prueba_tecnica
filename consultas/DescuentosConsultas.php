<?php

require_once __DIR__."/../conexion/conexion.php";

class DescuentosConsultas
{   
    //COMMIT DE PRUEBA Y PUSH v2
    public function todos()
    {
        $conexion = new Conexion();

        $conexion = $conexion->conexion()->prepare("SELECT * FROM descuentos");

        $conexion->execute();

        return $conexion->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscar($valor, $columna = 'id')
    {
        $conexion = new Conexion();

        $conexion = $conexion->conexion()->prepare("SELECT * FROM descuentos WHERE $columna = :valor");
        $conexion -> bindValue(":valor", $valor, PDO::PARAM_STR);
        $conexion->execute();

        return $conexion->fetch(PDO::FETCH_ASSOC);
    }
}

?>