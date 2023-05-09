<?php
require_once __DIR__."/consultas/DescuentosConsultas.php";

$consulta = new DescuentosConsultas();

print_r($consulta->buscar(1,"id"));
?>