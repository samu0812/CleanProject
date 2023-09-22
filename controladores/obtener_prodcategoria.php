<?php 
include("../bd/conexion.php");

$sql = "SELECT Descripcion FROM TipoCategoria";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["Descripcion"] . "'>" . $row["Descripcion"] . "</option>";
    }
} else {
    echo "No se encontraron tipos de tamaños en la base de datos.";
}
?>