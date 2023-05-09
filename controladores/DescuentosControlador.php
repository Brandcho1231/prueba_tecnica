<?php

require_once __DIR__."/../modelos/Descuentos.php";
require_once __DIR__."/../consultas/DescuentosConsultas.php";

class DescuentosControlador
{

    public function listarDescuentos()
    {
        $descuentosConsulta = new DescuentosConsultas();
        $listadoDescuentos = $descuentosConsulta->todos();

        foreach ($listadoDescuentos as $key => $value) {
            $descuento = new Descuento($value['id'], $value['consola'],$value['precio_minimo'],$value['precio_maximo'], $value['descuento']);
            $listado['descuentos'][] = $descuento; 
        }

        return $listado;
    }
}
?>