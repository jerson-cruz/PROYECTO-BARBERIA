<?php
// Conexión con la base de datos
include("conexion.php");

$cedula = $_POST['cedula'];
$contrasenaIngresada = $_POST['contrasena'];

// Preparar la consulta para obtener la contraseña almacenada de la base de datos
$stmt = $conexion->prepare("SELECT contrasena FROM registro WHERE cedula = ?");
$stmt->bind_param("s", $cedula);
$stmt->execute();
$stmt->store_result(); // Guardar el resultado para contar filas
$stmt->bind_result($contrasenaAlmacenada);
$stmt->fetch();

// esto verificara si la contraseña proporcionada es compatible con el documento
if ($stmt->num_rows > 0) { // Verifica que se haya encontrado un registro
  // Verificar la contraseña
  if (password_verify($contrasenaIngresada, $contrasenaAlmacenada)) {


    //si todo esta correcto nos dejara ingresar
    echo "<script>
                window.location.href = 'agendarcita.html';
              </script>";
  } else {
    // Contraseña incorrecta
    echo "<script>
                alert('Contraseña incorrecta');
                window.history.back(); 
              </script>";
  }
} else {
  // Cédula no encontrada
  echo "<script>
            alert('Documento no encontrado');
            window.history.back(); 
          </script>";
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
