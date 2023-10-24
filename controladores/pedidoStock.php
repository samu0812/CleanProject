<?php
session_start();
include('../bd/conexion.php');
try {
    // Verifica si se ha recibido una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Obtiene el cuerpo de la solicitud POST como una cadena JSON
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        $response = [
            'success' => true,
            'message' => 'Datos recibidos y procesados correctamente.'
        ];

        // Verifica si "datos" está presente en el arreglo
        if (isset($data['datos'])) {
            // Accede a los datos enviados desde JavaScript
            $datos = $data['datos'];
            $idSucursal = $_SESSION['idSucursales'];
            $idEmpleado = $_SESSION['idEmpleado'];
            // Construye la descripción que contiene todos los datos
            foreach ($datos as $dato) {
                $codigo = $dato['Código'];
                $nombre = $dato['Nombre'];
                $tipoProducto = $dato['Tipo'];
                $tamaño = $dato['Tamaño'];
                $medida = $dato['Medida'];
                $cantidad = $dato['Cantidad'];
            }

            // Obtiene la fecha actual en el formato deseado (ajusta el formato según tu base de datos)
            date_default_timezone_set('America/Argentina/Buenos_Aires');
            $fechaActual = date('Y-m-d H:i:s');

            // Realiza la inserción en la tabla "PedidosSucursales"
            $sql = "INSERT INTO PedidosSucursales (idEmpleado,fecha,codigoProducto,nombreProducto,tipoProducto,tamaño,medida,cantidad,idSucursales,estado) 
                    VALUES ('$idEmpleado','$fechaActual','$codigo','$nombre','$tipoProducto','$tamaño','$medida','$cantidad',$idSucursal,'En aprobacion')";

            if ($conn->query($sql) === TRUE) {
                // Inserción exitosa en "PedidosSucursales"
                // Puedes agregar aquí cualquier lógica adicional que necesites para el pedido
                
            } else {
                // Error en la inserción en "PedidosSucursales"
                $response = ['success' => false, 'message' => 'Error en la insercion a la tabla PedidosSucursales.'];
            }
        }

        // Convierte la respuesta a JSON y la envía de vuelta a JavaScript
        header("Content-Type: application/json");
        echo json_encode($response);
    }
} catch (Exception $e) {
    // Maneja el error, registra información de error si es necesario
    // Devuelve una respuesta HTTP con un código de estado de error
    http_response_code(500); // Código de estado para error interno del servidor
    echo json_encode(array("error" => $e->getMessage()));
}
?>
