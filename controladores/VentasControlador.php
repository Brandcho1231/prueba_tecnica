<?php

require_once __DIR__ . '/../modelos/Venta.php';
require_once __DIR__ . '/../modelos/Descuento.php';
require_once __DIR__ . '/../consultas/VentasConsultas.php';
require_once __DIR__ . '/../consultas/DescuentosConsultas.php';

class VentasControlador
{
    public function listarVentas()
    {
        $ventasConsulta = new VentasConsultas();
        $listadoVentas = $ventasConsulta->todos();

        $listado['status'] = "success";
        foreach ($listadoVentas as $key => $value) {
            $venta = new Venta($value['descuento_id'], $value['valor_sin_descuento'], $value['valor_a_descontar']);
            $venta->setId($value['id']);
            $listado['ventas'][] = $venta;
        }
        return $listado ?? null;
    }

    public function valorDescuento($consola, $valor)
    {
        $consultaDescuento = new DescuentosConsultas();
        $descuento = $consultaDescuento->buscar($consola, 'consola');
        if (!$descuento) {
            header('Content-Type: application/json');
            $array = [
                'status' => 'error',
                'error_id' => '400',
                'error_msg' => 'Datos incorrectos',
                'bandera' => 'Bandera',
            ];
        }else {
            $modeloDescuento = new Descuento($descuento['id'], $descuento['consola'], $descuento['precio_minimo'], $descuento['precio_maximo'], $descuento['porcentaje']);
        if ($modeloDescuento->getPrecioMaximo() == null) {
            $precioMaximo = $valor;
        } else {
            $precioMaximo = $modeloDescuento->getPrecioMaximo();
        }
        if ($valor >= $modeloDescuento->getPrecioMinimo() && $valor <= $precioMaximo) {
            
            $porcentaje = $modeloDescuento->getPorcentaje() / 100;
            $valorADescontar = $valor * $porcentaje;
            $valorDescuento = $valor - $valorADescontar;

            $array = [
                'valor_sin_descuento' => $valor,
                'valor_descuento' => intval($valorDescuento),
                'valor_a_descontar' => intval($valorADescontar),
                'consola' => $modeloDescuento->getConsola(),
            ];
        } else {
            $array = [
                'valor_sin_descuento' => $valor,
                'valor_descuento' => $valor,
                'valor_a_descontar' => 0,
                'consola' => $modeloDescuento->getConsola(),
            ];
        }
        }
        
        return $array;
    }

    public function guardarVenta($consola, $valor_sin_descuento)
    {
        $descuento = new DescuentosConsultas();
        $descuento = $descuento->buscar($consola, 'consola');
        if (!$descuento) {
            header('Content-Type: application/json');
            $respuesta = [
                'status' => 'error',
                'status_id' => '400',
                'error_msg' => 'Datos incorrectos',
            ];
        }else {
            $modeloDescuento = new Descuento($descuento['id'], $descuento['consola'], $descuento['precio_minimo'], $descuento['precio_maximo'], $descuento['porcentaje']);
        if ($modeloDescuento->getPrecioMaximo() == null) {
            $precioMaximo = $valor_sin_descuento;
        } else {
            $precioMaximo = $modeloDescuento->getPrecioMaximo();
        }

        if ($valor_sin_descuento >= $modeloDescuento->getPrecioMinimo() && $valor_sin_descuento <= $precioMaximo) {
            $porcentaje = $modeloDescuento->getPorcentaje() / 100;
            $valorADescontar = $valor_sin_descuento * $porcentaje;
            $valorDescuento = $valor_sin_descuento - $valorADescontar;
            $venta = new Venta($modeloDescuento->getId(), $valor_sin_descuento, $valorADescontar);
            $resultado = $venta->guardar();
            if ($resultado) {
                $respuesta = [
                    'status' => 'success',
                    'status_id' => '201',
                    'msg' => 'Se registro la venta',
                ];
            } else {
                $respuesta = [
                    'status' => 'error',
                    'status_id' => '409',
                    'msg' => 'No se pudo registrar la venta, intentalo nuevamente',
                ];
            }
        } else {
            $venta = new Venta(null, $valor_sin_descuento, 0);
            $resultado = $venta->guardar();
            if ($resultado) {
                $respuesta = [
                    'status' => 'success',
                    'status_id' => '201',
                    'msg' => 'Se registro la venta',
                ];
            } else {
                $respuesta = [
                    'status' => 'error',
                    'status_id' => '409',
                    'msg' => 'No se pudo registrar la venta, intentalo nuevamente',
                ];
            }
        }
        }
        
        return $respuesta;
    }

    public function descuentoTotal()
    {
        $ventas = $this->listarVentas();
        if ($ventas == null) {
            $respuesta = [
                'status' => 'success',
                'descuentoTotal' => 0,
            ];
        } else {
            $descuentoTotal = array_sum(array_column($ventas['ventas'], 'valor_a_descontar'));
            $respuesta = [
                'status' => 'success',
                'descuentoTotal' => $descuentoTotal,
            ];
        }

        return $respuesta;
    }
}
?>
