<?php
include("./conexion.php");

function verificarUsuario($cedula, $contrasenaIngresada, $contrasena, $conexion,)
// en esta parte nombre $contrasena para que el codigo no me salga con error, sin embargo se hicieron pruebas y es funcional sin nombrar $conexion
{
    // Preparar la consulta para obtener la contraseña almacenada de la base de datos
    $stmt = $conexion->prepare("SELECT contrasena FROM administradorregistro WHERE cedula = ?");
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $stmt->store_result(); // Guardar el resultado para contar filas
    $stmt->bind_result($contrasena);
    $stmt->fetch();

    // Verifica si se ha encontrado un registro
    if ($stmt->num_rows > 0) {
        // Verificar la contraseña
        if (password_verify($contrasenaIngresada, $contrasena)) {
            return true; // Usuario autenticado
        } else {
            return false; // Contraseña incorrecta
        }
    } else {
        return null; // Cédula no encontrada
    }
}
