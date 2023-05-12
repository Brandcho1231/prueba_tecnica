<?php

require_once __DIR__."/../modelos/Descuento.php";
require_once __DIR__."/../consultas/DescuentosConsultas.php";

class DescuentosControlador
{

    public function listarDescuentos()
    {
        $descuentosConsulta = new DescuentosConsultas();
        $listadoDescuentos = $descuentosConsulta->todos();

        foreach ($listadoDescuentos as $key => $value) {
            $descuento = new Descuento($value['id'], $value['consola'],$value['precio_minimo'],$value['precio_maximo'], $value['porcentaje']);
            $listado['descuentos'][] = $descuento;
        }
        $listado['status'] = "success"; 

        return $listado ?? null;
    }
}
?>