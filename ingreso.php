<?php
// Conexión con la base de datos
include("conexion.php");

$cedula = $_POST['cedula'];
$contrasena = $_POST['contrasena'];

// Preparar la consulta para obtener la contraseña almacenada de la base de datos
$stmt = $conexion->prepare("SELECT contrasena FROM registro WHERE cedula = ?");
$stmt->bind_param("s", $cedula);
$stmt->execute();
$stmt->bind_result($contrasena);
$stmt->fetch();

// Verificar si se encontró un registro con la cédula proporcionada
if ($contrasena !== null) {
    // Verificar la contraseña
    if ($contrasena == $contrasena) {
        echo "Ingreso correcto";
   
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Cédula no encontrada";
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
?>
