<?php
// Conexión con la base de datos
include("conexion.php");
header('Content-Type: application/json');

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Rango de horas
$start_time = '08:00:00';
$end_time = '19:00:00';
$interval = 60 * 60; // Intervalo de una hora en segundos

// Obtener todos los barberos
$barbers = $conn->query("SELECT id FROM barberosreal");

if ($barbers->num_rows > 0) {
    while ($barber = $barbers->fetch_assoc()) {
        $barber_id = $barber['id'];

        $current_time = strtotime($start_time);
        $end_time = strtotime($end_time);

        while ($current_time <= $end_time) {
            $time_slot = date('H:i:s', $current_time);

            // Inserta el horario disponible para el barbero
            $stmt = $conn->prepare("INSERT INTO disponibilidad (barbero_id, fecha, hora) VALUES (?, ?, ?)");
            $fecha = date('Y-m-d'); // Puedes ajustar la fecha según tus necesidades
            $stmt->bind_param("iss", $barber_id, $fecha, $time_slot);
            $stmt->execute();

            $current_time += $interval; // Incrementa el tiempo
        }
    }
}

$conn->close();
echo "Horarios disponibles insertados correctamente.";
