<?php
// eliminar_barbero.php

// Conectar a la base de datos
include("C:/xampp/htdocs/PEOYECTO_SENA/comunes/BACKEND/conexion.php");

if ($argc !== 2) {
    echo "Uso: php eliminar_barbero.php <documento>\n";
    exit(1);
}

$documento = $argv[1];

// Preparar y ejecutar la consulta de eliminación
$stmt = $conexion->prepare("DELETE FROM barberos WHERE documento = ?");
$stmt->bind_param("s", $documento);

if ($stmt->execute()) {
    // Verificar si se eliminó algún registro
    if ($stmt->affected_rows > 0) {
        echo "Barbero con documento $documento eliminado exitosamente.\n";
    } else {
        echo "No se encontró ningún barbero con el documento $documento.\n";
    }
} else {
    echo "Error al eliminar el barbero: " . $stmt->error . "\n";
}

$stmt->close();
$conexion->close();
