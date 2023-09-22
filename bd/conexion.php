<?php
$servername = "localhost";
$username = "root";
$password = "Francesco2020";
$dbname = "clean";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}   


// Aquí puedes realizar operaciones con la base de datos
?>
