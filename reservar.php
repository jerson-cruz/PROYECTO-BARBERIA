<?php
// Incluir el archivo de conexión
include("conexion.php");

// Recoger los datos del formulario
$barber_id = isset($_POST['barber']) ? intval($_POST['barber']) : 0;
$service = isset($_POST['service']) ? $_POST['service'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$hour = isset($_POST['hour']) ? $_POST['hour'] : '';
$client_name = isset($_POST['client_name']) ? $_POST['client_name'] : '';

// Crear conexión usando las variables definidas en conexion.php
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del servicio
$sql = "SELECT id FROM servicios WHERE barbero_id = ? AND nombre = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("is", $barber_id, $service);
$stmt->execute();
$result = $stmt->get_result();
$service_data = $result->fetch_assoc();

if ($service_data) {
    $service_id = $service_data['id'];

    // Insertar la reserva
    $sql = "INSERT INTO reservas (barbero_id, servicio_id, fecha, hora, cliente_nombre) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("iisss", $barber_id, $service_id, $date, $hour, $client_name);
    $stmt->execute();

    // Marcar la hora como reservada
    $sql = "UPDATE disponibilidad SET reservado = TRUE WHERE barbero_id = ? AND fecha = ? AND hora = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("iss", $barber_id, $date, $hour);
    $stmt->execute();

    echo json_encode(["status" => "success", "message" => "Reserva realizada con éxito."]);
} else {
    echo json_encode(["status" => "error", "message" => "Servicio no encontrado."]);
}

// Cerrar conexión
$conn->close();
