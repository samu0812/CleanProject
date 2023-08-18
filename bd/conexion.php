<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "clean";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos";

// Aquí puedes realizar operaciones con la base de datos

// Cerrar la conexión
$conn->close();
?>
