<?php

require_once __DIR__."/../conexion/conexion.php";

class VentasConsultas
{   
    //COMMIT DE PRUEBA Y PUSH v2
    public function todos()
    {
        $conexion = new Conexion();

        $conexion = $conexion->conexion()->prepare("SELECT * FROM ventas");

        $conexion->execute();

        return $conexion->fetchAll(PDO::FETCH_ASSOC);
    }


    public function buscar($valor, $columna = 'id')
    {
        $conexion = new Conexion();

        $conexion = $conexion->conexion()->prepare("SELECT * FROM ventas WHERE $columna = :valor");
        $conexion -> bindValue(":valor", $valor, PDO::PARAM_STR);
        $conexion->execute();

        return $conexion->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($descuento_id, $valor_sin_descuento, $valor_a_descontar)
    {
        $conexion = new Conexion();

        $conexion = $conexion->conexion()->prepare("INSERT INTO `ventas`
        (`descuento_id`, `valor_sin_descuento`, `valor_a_descontar`) 
        VALUES (:descuento_id, :valor_sin_descuento, :valor_a_descontar)");
        $conexion -> bindValue(":descuento_id", $descuento_id, PDO::PARAM_STR);
        $conexion -> bindValue(":valor_sin_descuento", $valor_sin_descuento, PDO::PARAM_STR);
        $conexion -> bindValue(":valor_a_descontar", $valor_a_descontar, PDO::PARAM_STR);

        return $conexion->execute();
    }
}

?>