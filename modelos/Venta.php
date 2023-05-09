<?php

class Venta
{
    public $descuento_id, $valor_sin_descuento, $valor_con_descuento;
    private $id;

    function __construct($id,$descuento_id, $valor_sin_descuento)
    {
        $this->setId($id);
        $this->setDescuentoId($descuento_id);
        $this->setValorSinDescuento($valor_sin_descuento);
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

    // public function setValorConDescuento()
    // {
    //     $valor_sin_descuento = $this->getValorSinDescuento();
    //     $valor_con_descuento = 
    // }

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
}

?>