<?php
include("../bd/conexion.php");

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idDetalleFactura"])) {
    $idDetalleFactura = $_POST["idDetalleFactura"];
    $idFactura = null;

    // Obtener el idFactura correspondiente al idDetalleFactura
    $sql = "SELECT idFacturas FROM detallefactura WHERE idDetalleFactura = $idDetalleFactura";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idFactura = $row["idFacturas"];
    }

    $sqlDatos = "SELECT idProductos, cantidad, idSucursales FROM ventas WHERE idDetalleFactura = $idDetalleFactura";

    // Ejecutar la consulta
    $resultDatos = $conn->query($sqlDatos);

    // Verificar si se obtuvieron resultados
    if ($resultDatos->num_rows > 0) {
    // Recorrer los resultados y mostrar los idProductos y cantidades
    while ($row = $resultDatos->fetch_assoc()) {
        $idProductos = $row["idProductos"];
        $cantidad = $row["cantidad"];
        $idSucursales = $row["idSucursales"];

        $sqlUpdateStock = "UPDATE stocksucursales 
        SET cantidad = cantidad + $cantidad 
        WHERE idProductos = '$idProductos' AND idSucursales = $idSucursales";
                
        $resultUpdateStock = $conn->query($sqlUpdateStock);
        
    }}



    if ($idFactura !== null) {
        // Realizar las eliminaciones en las tablas relacionadas
        $sql1 = "DELETE FROM ventas WHERE idDetalleFactura = $idDetalleFactura";
        $sql3 = "DELETE FROM detallefactura WHERE idDetalleFactura = $idDetalleFactura";
        $sql2 = "DELETE FROM facturas WHERE idFacturas = $idFactura";

        if ($conn->query($sql1) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql2) === TRUE) {
            echo "Venta cancelada y datos asociados eliminados con éxito.";
        } else {
            echo "Error al cancelar la venta: " . $conn->error;
        }

        $response = [
            'success' => true,
            'message' => 'La venta se ha cancelado con éxito.'
        ];
        echo json_encode($response);
    } else {
        echo "No se pudo cancelar la venta";
    }
} else {
    // Manejar el caso en que no se envíen datos correctamente
    echo "Error: No se pudo cancelar la venta";
}
?>
