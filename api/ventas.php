<?php
require_once __DIR__ . '/../controladores/VentasControlador.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $listado = new VentasControlador();
        echo json_encode($listado->descuentoTotal());
        break;
    case 'POST':
        if (isset($_POST['funcion'])) {
            if ($_POST['funcion'] == 'descuento') {
                if (isset($_POST['consola']) && isset($_POST['valor'])) {
                    if (is_string($_POST['consola']) && is_numeric($_POST['valor'])) {
                        $valor = intval($_POST['valor']);
                        $descuento = new VentasControlador();
                        echo json_encode($descuento->valorDescuento($_POST['consola'], $valor));
                    } else {
                        header('Content-Type: application/json');
                        $error = [
                            'status' => 'error',
                            'error_id' => '400',
                            'error_msg' => 'Datos incorrectos'
                        ];
                        echo json_encode($error);
                    }
                } else {
                    header('Content-Type: application/json');
                    $error = [
                        'status' => 'error',
                        'error_id' => '400',
                        'error_msg' => 'Faltan datos',
                    ];
                    echo json_encode($error);
                }
            } elseif ($_POST['funcion'] == 'guardar') {
                if (isset($_POST['consola']) && isset($_POST['valor_sin_descuento']) && isset($_POST['valor_a_descontar'])) {
                    if (is_string($_POST['consola']) && is_numeric($_POST['valor_sin_descuento']) && is_numeric($_POST['valor_a_descontar'])) {
                        $valorADescontar = intval($_POST['valor_a_descontar']);
                        $valorSinDescuento = intval($_POST['valor_sin_descuento']);
                        $venta = new VentasControlador();
                        echo json_encode($venta->guardarVenta($_POST['consola'], $valorADescontar, $valorSinDescuento));
                    }else {
                        header('Content-Type: application/json');
                        $error = [
                            'status' => 'error',
                            'error_id' => '400',
                            'error_msg' => 'Datos incorrectos'
                        ];
                        echo json_encode($error);
                    }
                }else {
                    header('Content-Type: application/json');
                    $error = [
                        'status' => 'error',
                        'error_id' => '400',
                        'error_msg' => 'Faltan datos',
                    ];
                    echo json_encode($error);
                }
            } else {
                header('Content-Type: application/json');
                $error = [
                    'status' => 'error',
                    'error_id' => '400',
                    'error_msg' => 'Datos incorrectos'
                ];
                echo json_encode($error);
            }
        } else {
            header('Content-Type: application/json');
            $error = [
                'status' => 'error',
                'error_id' => '400',
                'error_msg' => 'Datos incorrectos'
            ];
            echo json_encode($error);
        }
        break;
    default:
        header('Content-Type: application/json');
        $error = [
            'status' => 'error',
            'error_id' => '404',
            'error_msg' => 'La ruta que buscas no existe',
        ];
        echo json_encode($error);
        break;
}

?>
