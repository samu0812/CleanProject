<?php
// Conexión a la base de datos (reemplaza con tus propios valores)
include("../bd/conexion.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idDetalleFactura"])) {
    $idDetalleFactura = $_POST["idDetalleFactura"];

    // Consulta SQL para obtener los datos
    $sql = "SELECT v.idProductos, v.nroVenta, v.cantidad, v.PrecioProducto, v.nombreProducto, v.descuentoProducto, df.*, f.*
FROM ventas v
INNER JOIN detallefactura df ON v.idDetalleFactura = df.idDetalleFactura
INNER JOIN facturas f ON df.idFacturas = f.idFacturas
WHERE v.idDetalleFactura = $idDetalleFactura;
";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $productos = array(); // Inicializa un array para almacenar los productos

        while ($row = $result->fetch_assoc()) {
                // Consulta para obtener la descripción de FormaDePago
            $sqlFormaDePago = "SELECT descripcion FROM FormaDePago WHERE idFormaDePago = " . $row["idFormaDePago"];
            $resultFormaDePago = $conn->query($sqlFormaDePago);
            $formaDePagoDescripcion = "";
            if ($resultFormaDePago->num_rows > 0) {
                $formaDePagoRow = $resultFormaDePago->fetch_assoc();
                $formaDePagoDescripcion = $formaDePagoRow["descripcion"];
            }

            // Consulta para obtener la descripción de TipoFactura
            $sqlTipoFactura = "SELECT descripcion FROM TipoFactura WHERE idTipoFactura = " . $row["idTipoFactura"];
            $resultTipoFactura = $conn->query($sqlTipoFactura);
            $tipoFacturaDescripcion = "";
            if ($resultTipoFactura->num_rows > 0) {
                $tipoFacturaRow = $resultTipoFactura->fetch_assoc();
                $tipoFacturaDescripcion = $tipoFacturaRow["descripcion"];
            }
            // Aquí puedes acceder a los datos que necesitas
            $producto = array(
                'idProducto' => $row["idProductos"],
                'nroVenta' => $row["nroVenta"],
                'nombreProducto' => $row["nombreProducto"],
                'cantidad' => $row["cantidad"],
                'idDetalleFactura' => $row["idDetalleFactura"],
                'idFacturas' => $row["idFacturas"],
                'subTotal' => $row["SubTotal"],
                'total' => $row["Total"],
                'descuentos' => $row["Descuentos"],
                'recargos' => $row["Recargos"],
                'FechaEmision' => $row["FechaEmision"],
                'precioProducto' => $row["PrecioProducto"],
                'precioCantidad' => $row["PrecioProducto"]*$row["cantidad"],
                'dineroRecibido' => $row["dineroRecibido"],
                'descuentoProducto' => $row["descuentoProducto"],
                'vuelto' => $row["vuelto"],
                'tipoFacturaDescripcion' => $tipoFacturaDescripcion,
                'formaDePagoDescripcion' => $formaDePagoDescripcion,
            );

            // Agrega el producto al array
            $productos[] = $producto;
        }


        $response = [
            'success' => true,
            'message' => 'Datos enviados',
            'datos' => $productos // Envía todos los productos como respuesta
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        echo "No se encontraron resultados.";
    }

} else {
    // Manejar el caso en que no se envíen datos correctamente
    echo "Error: No se pudo abrir el comprobante";
}
?>
