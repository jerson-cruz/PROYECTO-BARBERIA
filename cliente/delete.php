
<?php
// Conexión con la base de datos
include("conexion.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = 14; // El id del registro que quieres eliminar

// Crear la consulta
$sql = "DELETE FROM registro WHERE id = $ 14";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado exitosamente";
} else {
    echo "Error al eliminar el registro: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>