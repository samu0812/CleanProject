<?php 
include("../bd/conexion.php");

$sql = "SELECT Descripcion FROM Sucursales";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $valor = 1; // Inicializa la variable $valor
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $valor . "'>" . $row["Descripcion"] . "</option>";
        $valor++; // Incrementa la variable $valor
    }
} else {
    echo "No se encontraron proveedores en la base de datos.";
}
?>
