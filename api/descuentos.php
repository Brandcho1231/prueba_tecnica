<?php

require_once __DIR__."/../controladores/DescuentosControlador.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $listado = new DescuentosControlador();
        echo json_encode($listado->listarDescuentos());
        break;
    default:
        # code...
        break;
}


?>