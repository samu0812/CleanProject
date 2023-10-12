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
        if (isset($data['datosPedido'])) {
            // Accede a los datos enviados desde JavaScript
            $datos = $data['datosPedido'];
            $idSucursal = $_SESSION['idSucursales'];
            $idEmpleado = $_SESSION['idEmpleado'];
            
            // Procesa cada pedido en los datos recibidos
            foreach ($datos as $dato) {
                $idPedido = $dato['idPedido'];
                $codigo = strval($dato['Codigo']);
                $cantidad = $dato['Cantidad'];

                // Actualiza el estado del pedido a "Entregado"
                $sqlUpdateEstado = "UPDATE pedidosSucursales SET estado = 'Entregado' WHERE idPedidosSucursales = '$idPedido'";
                if ($conn->query($sqlUpdateEstado) !== TRUE) {
                    $response = ['success' => false, 'message' => 'Error al actualizar el estado del pedido.'];
                    break; // Sale del bucle en caso de error
                }

                // Verifica si el producto ya existe en "StockSucursales" para esta sucursal
                $existenciaProducto = "SELECT COUNT(*) AS count FROM stockSucursales WHERE idProductos = '$codigo' AND idSucursales = '$idSucursal'";
                $result = $conn->query($existenciaProducto);

                if ($result) {
                    $row = $result->fetch_assoc();
                    $count = $row['count'];

                    if ($count > 0) {
                        // El producto ya existe, actualiza la cantidad
                        $sqlUpdateStockSumar = "UPDATE stockSucursales SET Cantidad = Cantidad + $cantidad WHERE idProductos = '$codigo' AND idSucursales = '$idSucursal'";
                        $sqlUpdateStockRestar = "UPDATE stockSucursales SET Cantidad = Cantidad - $cantidad WHERE idProductos = '$codigo' AND idSucursales = 1";
                        if ($conn->query($sqlUpdateStockSumar) !== TRUE || $conn->query($sqlUpdateStockRestar) !== TRUE) {
                            // Si hay un error en alguna de las consultas, muestra el mensaje de error
                            $response = ['success' => false, 'message' => 'Error al actualizar el stock.'];
                            $conn->rollback();
                            break; // Sale del bucle en caso de error
                        }
                    } else {
                        // El producto no existe, consulta la información del producto desde la tabla "productos"
                        $consultaStock = "SELECT Impuestos, PrecioFinal FROM StockSucursales WHERE idProductos = '$codigo'";
                        $stockConsulta = $conn->query($consultaStock);

                        if ($stockConsulta && $stockConsulta->num_rows > 0) {
                            $row = $stockConsulta->fetch_assoc();
                            $Impuesto = $row['Impuestos'];
                            $PrecioFinal = $row['PrecioFinal'];

                            // Inserta el nuevo producto en "stockSucursales"
                            $sqlInsertProducto = "INSERT INTO stockSucursales (idSucursales, idProductos, Cantidad, Impuestos, PrecioFinal) VALUES ('$idSucursal', '$codigo', '$cantidad', $Impuesto, $PrecioFinal)";
                            if ($conn->query($sqlInsertProducto) === TRUE) {
                                // Si la inserción fue exitosa, actualiza el stock de la sucursal 1
                                $sqlUpdateStockRestar = "UPDATE stockSucursales SET Cantidad = Cantidad - $cantidad WHERE idProductos = '$codigo' AND idSucursales = 1";
                                if ($conn->query($sqlUpdateStockRestar) !== TRUE) {
                                    // Si hay un error en la actualización del stock de la sucursal 1, muestra el mensaje de error
                                    $response = ['success' => false, 'message' => 'Error al actualizar el stock.'];
                                    $conn->rollback();
                                    break; // Sale del bucle en caso de error
                                }
                            } else {
                                // Si hay un error en la inserción del nuevo producto, muestra el mensaje de error
                                $response = ['success' => false, 'message' => 'Error al insertar el nuevo producto en stockSucursales.'];
                                $conn->rollback();
                                break; // Sale del bucle en caso de error
                            }
                        } else {
                            // El producto no existe en la tabla "productos"
                            $response = ['success' => false, 'message' => 'El producto no existe en la tabla de productos.'];
                            $conn->rollback();
                            break; // Sale del bucle en caso de error
                        }
                    }
                } else {
                    // Error en la consulta SQL
                    $response = ['success' => false, 'message' => 'Error en la consulta SQL.'];
                    $conn->rollback();
                    break; // Sale del bucle en caso de error
                }
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
