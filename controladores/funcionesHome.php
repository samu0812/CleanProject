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
        case 'ObtenerGananciasPorMeses':
            // Lógica para listar proveedores
            ObtenerGananciasPorMeses($conn); // Pasa la conexión como parámetro
            break;

        case 'totalRecaudadoPorSucursal':
            // Lógica para listar proveedores
            totalRecaudadoPorSucursal($conn); // Pasa la conexión como parámetro
            break;    
            
        case 'actualizarGraficoTortaAnual':
            // Lógica para listar proveedores
            actualizarGraficoTortaAnual($conn); // Pasa la conexión como parámetro
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
        $sql = "SELECT
            P.Nombre AS NombreProducto,
            CAST(SUM(V.cantidad) AS SIGNED) AS CantidadVendida
        FROM
            ventas V
        INNER JOIN
            productos P ON V.idProductos = P.idProductos
        GROUP BY
            P.idProductos, P.Nombre
        ORDER BY
            CantidadVendida DESC
        LIMIT
            7;";
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
    
        // Devuelve la respuesta en formato JSON con un código de estado 200 (OK)
        header("Content-Type: application/json");
        echo json_encode($productosMasVendidos);
    } catch (Exception $e) {
        // Maneja el error y devuelve una respuesta JSON con un código de estado 500 (Error interno del servidor)
        http_response_code(500);
        echo json_encode(array("error" => $e->getMessage()));
    }
    

        // $productosMasVendidos = "sadasd";
        // header("Content-Type: application/json");
        // echo json_encode($productosMasVendidos);
}


function ObtenerGananciasPorMeses($conn) {
    try {
        // Realiza la consulta SQL para obtener los 10 productos más vendidos
        $sql = " SELECT
        Anio,
        CASE
            WHEN Mes = 1 THEN 'Enero'
            WHEN Mes = 2 THEN 'Febrero'
            WHEN Mes = 3 THEN 'Marzo'
            WHEN Mes = 4 THEN 'Abril'
            WHEN Mes = 5 THEN 'Mayo'
            WHEN Mes = 6 THEN 'Junio'
            WHEN Mes = 7 THEN 'Julio'
            WHEN Mes = 8 THEN 'Agosto'
            WHEN Mes = 9 THEN 'Septiembre'
            WHEN Mes = 10 THEN 'Octubre'
            WHEN Mes = 11 THEN 'Noviembre'
            WHEN Mes = 12 THEN 'Diciembre'
        END AS MesNombre,
        TotalRecaudado
    FROM (
        SELECT
            YEAR(Fecha) AS Anio,
            MONTH(Fecha) AS Mes,
            SUM(df.Total) AS TotalRecaudado
        FROM Ventas AS v
        INNER JOIN DetalleFactura AS df ON v.idDetalleFactura = df.idDetalleFactura
        WHERE Fecha >= DATE_SUB(CURRENT_DATE, INTERVAL 4 MONTH) 
        GROUP BY Anio, Mes
    ) AS Subconsulta
    ORDER BY Anio DESC, Mes DESC;";
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

function totalRecaudadoPorSucursal($conn) {
    try {
        // Realiza la consulta SQL para obtener el total recaudado por sucursal en el mes actual
        $sql = "SELECT
            s.Descripcion AS Sucursal,
            SUM(d.Total) AS TotalRecaudado
        FROM
            Ventas v
        INNER JOIN
            Sucursales s ON v.idSucursales = s.idSucursales
        INNER JOIN
            DetalleFactura d ON v.idDetalleFactura = d.idDetalleFactura
        WHERE
            YEAR(v.Fecha) = YEAR(CURDATE()) AND
            MONTH(v.Fecha) = MONTH(CURDATE())  -- Obtener ventas del mes actual
        GROUP BY
            s.Descripcion;";
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

function actualizarGraficoTortaAnual($conn) {
    try {
        // Realiza la consulta SQL para obtener el total recaudado por sucursal en el mes actual
        $sql = "SELECT
        s.Descripcion AS Sucursal,
        SUM(d.Total) AS TotalRecaudado
    FROM
        Ventas v
    INNER JOIN
        Sucursales s ON v.idSucursales = s.idSucursales
    INNER JOIN
        DetalleFactura d ON v.idDetalleFactura = d.idDetalleFactura
    WHERE
        YEAR(v.Fecha) = YEAR(CURDATE())  -- Obtener ventas del año actual
    GROUP BY
        s.Descripcion, YEAR(v.Fecha);";
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