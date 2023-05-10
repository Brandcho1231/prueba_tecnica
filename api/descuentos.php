<?php

require_once __DIR__ . '/../controladores/DescuentosControlador.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $listado = new DescuentosControlador();
        echo json_encode($listado->listarDescuentos());
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
