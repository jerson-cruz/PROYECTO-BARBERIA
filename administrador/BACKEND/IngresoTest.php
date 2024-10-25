<?php

use PHPUnit\Framework\TestCase;

class IngresoTest extends TestCase
{
  protected $conexion;

  protected function setUp(): void
  {
    // Conexión a la base de datos
    include("./comunes/BACKEND/conexion.php");
    $this->conexion = $conexion;

    // Asegúrate de que la función verificarUsuario esté disponible
    include_once("./comunes/BACKEND/authTest.php");
  }

  public function testIngreso()
  {
    $cedula = '333'; // Cédula existente
    $contrasena = '123456';

    // Asumiendo que ya has insertado un registro en la base de datos con esta cédula y contraseña
    $resultado = verificarUsuario($cedula, $contrasena, $this->conexion);
    $this->assertTrue($resultado);
  }

  public function testVerificarUsuarioConContrasenaIncorrecta()
  {
    $cedula = '333'; // Cédula existente
    $contrasenaIncorrecta = '321654';

    $resultado = verificarUsuario($cedula, $contrasenaIncorrecta, $this->conexion);
    $this->assertFalse($resultado);
  }

  public function testVerificarUsuarioConCedulaNoEncontrada()
  {
    $cedula = '77777'; // Cédula que no existe
    $contrasena = '123456';

    $resultado = verificarUsuario($cedula, $contrasena, $this->conexion);
    $this->assertNull($resultado);
  }

  protected function tearDown(): void
  {
    // Cerrar la conexión
    if ($this->conexion) {
      $this->conexion->close();
    }
  }
}
