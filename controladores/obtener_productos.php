<?php 
// Conexión a la base de datos (asegúrate de tener la conexión establecida)
$conexion = new mysqli("localhost", "root", "root", "clean");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT P.idProductos, P.Nombre, Pr.Nombre AS Proveedor, TP.Descripcion AS TipoProd, TC.Descripcion AS TipoCat, TT.Abreviatura AS Tamaño, P.Tamaño AS Medida, SUM(SS.Cantidad) AS CantidadTotal, P.PrecioCosto, SS.Impuestos AS Impuesto, SS.PrecioFinal
        FROM Productos P
        INNER JOIN Proveedores Pr ON P.idProveedores = Pr.idProveedores
        INNER JOIN TipoProducto TP ON P.idTipoProducto = TP.idTipoProducto
        INNER JOIN TipoCategoria TC ON P.idTipoCategoria = TC.idTipoCategoria
        INNER JOIN TipoTamaño TT ON P.idTipoTamaño = TT.idTipoTamaño
        INNER JOIN StockSucursales SS ON P.idProductos = SS.idProductos
        GROUP BY P.idProductos, P.Nombre, Pr.Nombre, TP.Descripcion, TC.Descripcion, TT.Abreviatura, P.Tamaño, P.PrecioCosto, SS.Impuestos, SS.PrecioFinal";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $fila['idProductos'] . '</td>';
        echo '<td>' . $fila['Nombre'] . '</td>';
        echo '<td>' . $fila['Proveedor'] . '</td>';
        echo '<td>' . $fila['TipoProd'] . '</td>';
        echo '<td>' . $fila['TipoCat'] . '</td>';
        echo '<td>' . $fila['Tamaño'] . '</td>';
        echo '<td>' . $fila['Medida'] . '</td>';
        echo '<td>' . $fila['CantidadTotal'] . '</td>'; // Mostrar la suma de Cantidad
        echo '<td>' . $fila['PrecioCosto'] . '</td>';
        echo '<td>' . $fila['Impuesto'] . '</td>'; // Mostrar el Impuesto
        echo '<td>' . $fila['PrecioFinal'] . '</td>';
        echo '<td>' . "" . '</td>';
        echo '</tr>';
    }
} else {
    echo "<tr><td colspan='3'>No se encontraron productos.</td></tr>";
}
$conexion->close();
?>
