<?php

class Descuento
{
    public $consola, $precio_minimo, $precio_maximo, $porcentaje;
    private $id;

    function __construct($id,$consola, $precio_minimo, $precio_maximo,$porcentaje)
    {
        $this->setId($id);
        $this->setConsola($consola);
        $this->setPrecioMinimo($precio_minimo);
        $this->setPorcentaje($porcentaje);
        $this->setPrecioMaximo($precio_maximo);
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

    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }

    public function setPrecioMaximo($precio_maximo)
    {
        $this->precio_maximo = $precio_maximo;
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

    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    public function getPrecioMaximo()
    {
        return $this->precio_maximo;
    }
}
?>
