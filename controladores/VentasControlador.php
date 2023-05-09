<?php

require_once __DIR__."/../modelos/Ventas.php";
require_once __DIR__."/../consultas/VentasConsultas.php";

class VentasControlador
{

    public function listarVentas()
    {
        $ventasConsulta = new VentasConsultas();
        $listadoVentas = $ventasConsulta->todos();

        foreach ($listadoVentas as $key => $value) {
            $venta = new Venta($value['id'], $value['descuento_id'],$value['valor_sin_descuento']);
            $listado['ventas'][] = $venta; 
        }

        return $listado;
    }

    public function guardarVenta()
    {

    }
}
?>