<?php
include("conexion.php");

$barberId = $_GET['barber'];
$date = $_GET['date'] ?? null;

if ($date) {
    $query = "SELECT hora FROM disponibilidad WHERE id_barbero = ? AND fecha = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("is", $barberId, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $horas = array();
    while ($row = $result->fetch_assoc()) {
        $horas[] = $row['hora'];
    }

    header('Content-Type: application/json');
    echo json_encode(array($date => $horas));
} else {
    $query = "SELECT fecha FROM disponibilidad WHERE id_barbero = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $barberId);
    $stmt->execute();
    $result = $stmt->get_result();

    $fechas = array();
    while ($row = $result->fetch_assoc()) {
        $fechas[] = $row['fecha'];
    }

    header('Content-Type: application/json');
    echo json_encode(array_combine($fechas, array_fill(0, count($fechas), [])));
}

$conexion->close();
