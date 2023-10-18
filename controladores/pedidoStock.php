<?php
session_start();
include('../bd/conexion.php');
try{
    // Verifica si se ha recibido una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtiene el cuerpo de la solicitud POST como una cadena JSON
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
    $response = [
        'success' => true,
        'message' => 'Datos recibidos y procesados correctamente.'
    ];



    //Verifica si "datos" está presente en el arreglo
    if (isset($data['datos'])) {
        // Accede a los datos enviados desde JavaScript
        $datos = $data['datos'];
        $idSucursal= $_SESSION['idSucursales'];
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
        $fechaActual = date('Y-m-d');

        // Realiza la inserción en la tabla "PedidosSucursales"
        $sql = "INSERT INTO PedidosSucursales (idEmpleado,fecha,codigoProducto,nombreProducto,tipoProducto,tamaño,medida,cantidad) 
                VALUES ('$idEmpleado','$fechaActual','$codigo','$nombre','$tipoProducto','$tamaño','$medida','$cantidad')";

        if ($conn->query($sql) === TRUE) {
            // Inserción exitosa en "PedidosSucursales"
            // Ahora actualiza la cantidad en "StockSucursales" o inserta un nuevo registro si no existe

            foreach ($datos as $dato) {
                $codigo = $dato['Código'];
                $cantidad = $dato['Cantidad'];

                // Verifica si el producto ya existe en "StockSucursales" para esta sucursal
                $existenciaProducto = "SELECT COUNT(*) AS count FROM stockSucursales WHERE idProductos = '$codigo' and idSucursales= $idSucursal";
                $result = $conn->query($existenciaProducto);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $count = $row['count'];
                    

                    if ($count > 0) {
                        // El producto ya existe, actualiza la cantidad
                        $sqlUpdateStockSumar = "UPDATE stockSucursales SET Cantidad = Cantidad + $cantidad WHERE idProductos = '$codigo' and idSucursales=$idSucursal";
                        $sqlUpdateStock = "UPDATE stockSucursales SET Cantidad = Cantidad - $cantidad WHERE idProductos = '$codigo' and idSucursales=1";
                        if ($conn->query($sqlUpdateStockSumar) === TRUE) {
                            // La actualización fue exitosa
                        } else {
                            // Si hay un error en la consulta, muestra el mensaje de error
                            echo "Error en la consulta: " . $conn->error;
                        } 
                    }else {
                        $consultaStock= "SELECT Impuestos,PrecioFinal FROM stockSucursales where idProductos= '$codigo'";
                        $stockConsulta= $conn->query($consultaStock);
                        $row= $stockConsulta->fetch_assoc();
                        $Impuesto= $row['Impuestos'];
                        $PrecioFinal= $row['PrecioFinal'];

                        $sqlInsertProducto = "INSERT INTO stockSucursales (idSucursales, idProductos, Cantidad, Impuestos, PrecioFinal) 
                                            VALUES ('$idSucursal', '$codigo', '$cantidad',$Impuesto,$PrecioFinal)";
                        $sqlUpdateStock = "UPDATE stockSucursales SET Cantidad = Cantidad - $cantidad WHERE idProductos = '$codigo' and idSucursales=1";
                        if ($conn->query($sqlInsertProducto) !== TRUE) {
                            // Error en la inserción
                            $response = ['success' => false, 'message' => 'Error en la inserción de StockSucursales.'];
                            $conn->rollback();
                            break;
                        }
    
                    }
                    
                    if ($conn->query($sqlUpdateStock) !== TRUE) {
                        // Error en la actualización/inserción de "StockSucursales"
                        $response = ['success' => false, 'message' => 'error en la actualizacion e insercion a la tabla stockSucursales.'];
                        $conn->rollback(); // Deshace la transacción en caso de error
                        break; // Sale del bucle en caso de error
                    }
                } else {
                    // Error al verificar la existencia del producto
                    $response = ['success' => false, 'message' => 'error de productos.'];
                    $conn->rollback(); // Deshace la transacción en caso de error
                    break; // Sale del bucle en caso de error
                }
            }
        } else {
            // Error en la inserción en "PedidosSucursales"
            $response = ['success' => false, 'message' => 'error en la insercion a la tabla pedidos.'];
            $conn->rollback(); // Deshace la transacción en caso de error
        }

        // Finaliza la transacción
        $conn->commit();

        // Cierra la conexión a la base de datos
        $conn->close();

        // Envía una respuesta de éxito (puedes personalizarla según tus necesidades)
        $response = ['success' => true, 'message' => 'Datos recibidos y procesados correctamente.'];
    }


        // Convierte la respuesta a JSON y la envía de vuelta a JavaScript
        header("Content-Type: application/json");
        echo json_encode($response);

    }
}catch (Exception $e) {
    // Maneja el error, registra información de error si es necesario
    // Devuelve una respuesta HTTP con un código de estado de error
    http_response_code(500); // Código de estado para error interno del servidor
    echo json_encode(array("error" => $e->getMessage()));
}
?>
