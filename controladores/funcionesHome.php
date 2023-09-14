<?php 
include '../bd/conexion.php'; // Incluye el archivo de conexión

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'obtenerCantidadProductos':
            // Lógica para listar proveedores
            obtenerCantidadProductos($conn); // Pasa la conexión como parámetro
            break;
        case 'obtenerProductosMasVendidos':
            // Lógica para listar proveedores
            obtenerProductosMasVendidos($conn); // Pasa la conexión como parámetro
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


function obtenerCantidadProductos($conn) {
    try {
        // Realiza la consulta SQL para obtener la cantidad total de productos en todas las sucursales
        $sql = "SELECT SUM(Cantidad) AS TotalProductos FROM StockSucursales";
        $stmt = $conn->prepare($sql);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta");
        }

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Extrae el resultado y almacénalo en un arreglo asociativo
        $response = array(
            "TotalProductos" => $row['TotalProductos']
        );

        // Devuelve la respuesta en formato JSON
        header("Content-Type: application/json");
        echo json_encode($response);
    } catch (Exception $e) {
        // Maneja el error, registra información de error si es necesario
        // Devuelve una respuesta HTTP con un código de estado de error
        http_response_code(500); // Código de estado para error interno del servidor
        echo json_encode(array("error" => $e->getMessage()));
    }

}

function obtenerProductosMasVendidos($conn) {
    try {
        // Realiza la consulta SQL para obtener los 10 productos más vendidos
        $sql = "SELECT P.Nombre AS NombreProducto, SUM(1) AS CantidadVendida
                FROM Ventas AS V
                JOIN Productos AS P ON V.idProductos = P.idProductos
                GROUP BY P.Nombre
                ORDER BY CantidadVendida DESC
                LIMIT 10";
        $stmt = $conn->prepare($sql);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta");
        }

        $result = $stmt->get_result();
        $productosMasVendidos = array();

        while ($row = $result->fetch_assoc()) {
            // Almacena cada producto más vendido en un arreglo
            $productosMasVendidos[] = $row;
        }

        // Devuelve la respuesta en formato JSON
        header("Content-Type: application/json");
        echo json_encode($productosMasVendidos);
    } catch (Exception $e) {
        // Maneja el error, registra información de error si es necesario
        // Devuelve una respuesta HTTP con un código de estado de error
        http_response_code(500); // Código de estado para error interno del servidor
        echo json_encode(array("error" => $e->getMessage()));
    }
}
?>