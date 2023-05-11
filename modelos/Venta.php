<?php

class Venta
{
    public $valor_sin_descuento, $valor_a_descontar,$id, $total_venta, $descuento;
    private $descuento_id; 

    function __construct($descuento_id = null, $valor_sin_descuento,$valor_a_descontar)
    {
        $this->setDescuentoId($descuento_id);
        $this->setValorSinDescuento($valor_sin_descuento);
        $this->setValorADescontar($valor_a_descontar);
        $this->setTotalVenta();
        $this->setDescuento();
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

    public function setTotalVenta()
    {
        $this->total_venta = $this->getValorSinDescuento() - $this->getValorADescontar();
    }

    public function setDescuento()
    {
        require_once __DIR__."/../consultas/DescuentosConsultas.php";
        $descuento = new DescuentosConsultas();
        $descuento = $descuento->buscar($this->getDescuentoId());
        if ($descuento) {
            $descuento = new Descuento($descuento['id'], $descuento['consola'],$descuento['precio_minimo'],$descuento['precio_maximo'], $descuento['porcentaje']);
            $this->descuento = $descuento;
        }else {
            $this->descuento = null;
        }
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

    public function getTotalVenta()
    {
        return $this->total_venta;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function guardar()
    {
        require_once __DIR__."/../consultas/VentasConsultas.php";
        $ventaConsultas = new VentasConsultas();
        return $ventaConsultas->guardar($this->getDescuentoId(),$this->getValorSinDescuento(),$this->getValorADescontar());
    }
}

?>