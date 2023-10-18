<?php 
include '../bd/conexion.php'; // Incluye el archivo de conexión

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'generarTablaVentas':
            generarTablaVentas($conn); // Pasa la conexión como parámetro
            break; 
        default:
            // Acción no válida
            echo json_encode(array("message" => "Acción no válida"));
            break;
    }
} else {
    // No se proporcionó ninguna acción válida en la solicitud
    echo json_encode(array("message" => "Acción no válida"));
}

function generarTablaVentas($conn) {

    try {
        // Realiza la consulta SQL para obtener el total recaudado por sucursal en el mes actual
        $sql = "SELECT DATE(V.Fecha) AS Fecha, P.Nombre AS Producto, V.cantidad, PER.Nombre AS Vendedor, S.Descripcion AS Sucursal, DF.Total
        FROM ventas V
        INNER JOIN detallefactura DF ON V.idDetalleFactura = DF.idDetalleFactura
        INNER JOIN productos P ON V.idProductos = P.idProductos
        INNER JOIN empleado E ON V.idEmpleado = E.idEmpleado
        INNER JOIN sucursales S ON V.idSucursales = S.idSucursales
        INNER JOIN persona PER ON E.idPersona = PER.idPersona
        ORDER BY Fecha DESC;";
        $stmt = $conn->prepare($sql);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta");
        }

        $result = $stmt->get_result();
        $gananciasPorSucursal = array();

        while ($row = $result->fetch_assoc()) {
            // Almacena cada resultado en un arreglo
            $gananciasPorSucursal[] = $row;
        }

        // Devuelve la respuesta en formato JSON
        header("Content-Type: application/json");
        echo json_encode($gananciasPorSucursal);
    } catch (Exception $e) {
        // Maneja el error, registra información de error si es necesario
        // Devuelve una respuesta HTTP con un código de estado de error
        http_response_code(500); // Código de estado para error interno del servidor
        echo json_encode(array("error" => $e->getMessage()));
    }
}


?>