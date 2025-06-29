<?php
include("conexion.php");

$query = "SELECT nombre-servicio, precio FROM servicios";
$result = $conexion->query($query);

$servicios = array();
while ($row = $result->fetch_assoc()) {
    $servicios[] = $row;
}

header('Content-Type: application/json');
echo json_encode($servicios);

$conexion->close();
