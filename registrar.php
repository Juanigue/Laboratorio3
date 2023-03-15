<?php
// Conectarse a la base de datos
$servername = "localhost";
$username = "nombre_usuario";
$password = "contraseña";
$dbname = "nombre_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
  die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Recuperar los datos del formulario
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$password = $_POST["password"];

// Verificar si el correo electrónico ya existe en la base de datos
$sql = "SELECT * FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "El correo electrónico ya está registrado";
} else {
  // Insertar el nuevo usuario en la base de datos
  $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso";
  } else {
    echo "Error al registrar el usuario: " . $conn->error;
  }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>