<?php
session_start();
include("../bd/conexion.php");
$idEmpleado = isset($_SESSION['idEmpleado']) ? $_SESSION['idEmpleado'] : '';
$idSucursales = isset($_SESSION['idSucursales']) ? $_SESSION['idSucursales'] : '';

if (isset($_POST['ventaData'])) {
    $ventaData = json_decode($_POST['ventaData'], true);
    $fecha = date('Y-m-d H:i:s');

    // Accede a los datos de la card
    $subtotal = $ventaData['card']['subtotal'];
    $descuentos = $ventaData['card']['descuentos'];
    $totalVenta = $ventaData['card']['totalVenta'];
    $tipoDocumento = $ventaData['card']['tipoDocumento'];
    $recargos = $ventaData['card']['recargos'];
    $tipoPago = $ventaData['card']['tipoPago'];
    $destinatario = 1;
    $nroVenta = $ventaData['card']['nroVenta'];
    $efectivoRecibido = $ventaData['card']['efectivoRecibido'];

    // Insertar Datos en tabla Facturas
    $sql = "INSERT INTO Facturas (idTipoDestinatarioFactura, idTipoFactura, idFormaDePago, FechaEmision) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $destinatario, $tipoDocumento, $tipoPago, $fecha);
    $stmt->execute();
    $idFactura = $stmt->insert_id;

    // Insertar Datos en tabla DetalleFactura
    $sql = "INSERT INTO DetalleFactura (idFacturas, SubTotal, Total, Descuentos, Recargos) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idddd", $idFactura, $subtotal, $totalVenta, $descuentos, $recargos);
    $stmt->execute();
    $idDetalleFactura = $stmt->insert_id;

    // Accede a los datos de la tabla de productos
    $productos = $ventaData['productos'];
    foreach ($productos as $producto) {
        $idProducto = $producto['id'];
        $nombreProducto = $producto['nombre'];
        $cantidad = $producto['cantidad'];
        $cantidadStock = $producto['cantidadStock'];
        $actualizarStock = $cantidadStock - $cantidad; // Resta la cantidad vendida al stock actual
    
        $sql = "INSERT INTO Ventas (idEmpleado, idProductos, idDetalleFactura, idSucursales, Fecha, nroVenta, cantidad) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiiisii", $idEmpleado, $idProducto, $idDetalleFactura, $idSucursales, $fecha, $nroVenta, $cantidad);
        $stmt->execute();
        $stmt->close();
    
        // Actualizar el stock en StockSucursales
        $sql = "UPDATE StockSucursales SET Cantidad = ? WHERE idProductos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $actualizarStock, $idProducto); 
        $stmt->execute();
        $stmt->close();
    }

    // Envía una respuesta de confirmación al cliente
    $response = [
        'success' => true,
        'message' => 'La venta se ha registrado con éxito.'
    ];

    echo json_encode($response);
} else {
    // Manejar el caso en que no se envíen datos correctamente
    echo "Error: No se han recibido datos de venta.";
}
?>
