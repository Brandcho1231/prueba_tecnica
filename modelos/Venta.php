<?php

class Venta
{
    public $descuento_id, $valor_sin_descuento, $valor_a_descontar;
    private $id;

    function __construct($descuento_id = null, $valor_sin_descuento,$valor_a_descontar)
    {
        $this->setDescuentoId($descuento_id);
        $this->setValorSinDescuento($valor_sin_descuento);
        $this->setValorADescontar($valor_a_descontar);
    }

    //setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setDescuentoId($descuento_id)
    {
        $this->descuento_id = $descuento_id;
    }

    public function setValorSinDescuento($valor_sin_descuento)
    {
        $this->valor_sin_descuento = $valor_sin_descuento;
    }

    public function setValorADescontar($valor_a_descontar)
    {
        $this->valor_a_descontar = $valor_a_descontar;
    }

    //getters 
    public function getId()
    {
        return $this->id;
    }

    public function getDescuentoId()
    {
        return $this->descuento_id;
    }

    public function getValorSinDescuento()
    {
        return $this->valor_sin_descuento;
    }

    public function getValorADescontar()
    {
        return $this->valor_a_descontar;
    }

    public function guardar()
    {
        require_once __DIR__."/../consultas/VentasConsultas.php";
        $ventaConsultas = new VentasConsultas();
        return $ventaConsultas->guardar($this->getDescuentoId(),$this->getValorSinDescuento(),$this->getValorADescontar());


    }
}

?>