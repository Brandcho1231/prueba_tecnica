<?php
require_once __DIR__."/../controladores/DescuentosControlador.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['consola']) && isset($_GET['valor'])) {
            
        }else {
            $listado = new VentasControlador();
            echo json_encode($listado->listarVentas());
        }
        break;
    default:
        # code...
        break;
}


?>