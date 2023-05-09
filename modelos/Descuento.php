<?php

class Descuento
{
    public $consola, $precio_minimo, $precio_maximo, $descuento;
    private $id;

    function __construct($id,$consola, $precio_minimo, $precio_maximo, $descuento)
    {
        $this->setId($id);
        $this->setConsola($consola);
        $this->setPrecioMinimo($precio_minimo);
        $this->setPrecioMaximo($precio_maximo);
        $this->setDescuento($descuento);
    }

    //setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setConsola($consola)
    {
        $this->consola = $consola;
    }

    public function setPrecioMinimo($precio_minimo)
    {
        $this->precio_minimo = $precio_minimo;
    }

    public function setPrecioMaximo($precio_maximo)
    {
        $this->precio_maximo = $precio_maximo;
    }

    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    //getters 
    public function getId()
    {
        return $this->id;
    }

    public function getConsola()
    {
        return $this->consola;
    }

    public function getPrecioMinimo()
    {
        return $this->precio_minimo;
    }

    public function getPrecioMaximo()
    {
        return $this->precio_maximo;
    }

    public function getDescuento($descuento)
    {
        return $this->descuento;
    }
}
?>
