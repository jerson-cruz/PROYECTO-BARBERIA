<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Consulta para obtener la lista de barberos
$sql = "SELECT id, nombre FROM barberos"; // Asumiendo que hay una tabla 'barberos' con 'id' y 'nombre'
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Barberos Disponibles</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['nombre'] . " (ID: " . $row['id'] . ")</li>";
    }
    echo "</ul>";
} else {
    echo "No hay barberos disponibles.";
}

$conn->close(); // Cerrar la conexión
