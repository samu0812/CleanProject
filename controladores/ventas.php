<?php
// Conexión a la base de datos (ajusta las credenciales según tu configuración).

include("../bd/conexion.php");
session_start();


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el término de búsqueda desde la solicitud AJAX.
$query = $_POST['query'];

// Consulta SQL para buscar productos por nombre o código.
$idSucursales= isset($_SESSION['idSucursales']) ? $_SESSION['idSucursales'] : '';


$sql = "SELECT *
FROM VistaProductosStock
WHERE idSucursales = $idSucursales 
    AND CantidadStock > 0
    AND (NombreProducto LIKE '%$query%' OR idProducto LIKE '%$query%')
"; 
// Establece la conexión a la base de datos (reemplaza con tus propios detalles de conexión)

$result = $conn->query($sql);

// Crear un array de resultados.
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Concatenar abreviatura y tamaño y agregarlos a la sugerencia
        $tamañoConAbreviatura = $row['Tamaño'] . ' ' . $row['AbreviaturaTipoTamaño'];
        // Agregar datos adicionales al elemento HTML para usarlos más tarde
        echo '<div class="autocomplete-suggestion" data-producto-id="' . $row['idProducto'] . '" data-precio="' . $row['PrecioFinalStock'] . 
        '" data-nombre="' . $row['NombreProducto'] .
        '" data-tipo-producto="' . $row['DescripcionTipoProducto'] . '" data-tipo-categoria="' . 
        $row['DescripcionTipoCategoria'] . '" data-abreviatura="' . $row['AbreviaturaTipoTamaño'] . '" data-cantidad-stock="' . 
        $row['CantidadStock'] . '" data-tamaño="' . $tamañoConAbreviatura . '">' . $row['NombreProducto'] . ' - Precio: S./' . $row['PrecioFinalStock'] . 
         ' / ' . $row['DescripcionTipoProducto'] .  ' / ' . $row['DescripcionTipoCategoria'] . ' / ' . $tamañoConAbreviatura . '</div>';
    }
} 
?>

