<?php
// Conexión con la base de datos
include("conexion.php");
header('Content-Type: application/json');

// Crear conexión usando la variable de conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los barberos
$query = "SELECT * FROM barberosreal "; // Asegúrate de que esta tabla exista
$result = $conn->query($query);

$barbers = [];
while ($row = $result->fetch_assoc()) {
    $barbers[] = $row;
}

echo json_encode($barbers);

$conn->close();
