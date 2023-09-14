<?php 
include("../bd/conexion.php");

$sql = "SELECT Nombre FROM Proveedores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["Nombre"] . "'>" . $row["Nombre"] . "</option>";
    }
} else {
    echo "No se encontraron proveedores en la base de datos.";
}
?>