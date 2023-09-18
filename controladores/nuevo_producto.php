<?php 
include '../bd/conexion.php'; // Incluye el archivo de conexión

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'listar':
            // Lógica para listar proveedores
            listarProductos($conn); // Pasa la conexión como parámetro
            break;
        case 'listarcards':
            // Lógica para listar proveedores
            obtenerCantStockPorSucursal($conn); // Pasa la conexión como parámetro
            break;
        case 'verificarcodigo':
            // Lógica para listar proveedores
            codigoExiste2($conn); // Pasa la conexión como parámetro
            break;
        case 'agregar':
            // Lógica para agregar un proveedor
            agregarProductos($conn);
            break;
        case 'obtener':
            obtenerProductos($conn);
            break;
        case 'editar':
            // Lógica para editar un proveedor
            editarProductos($conn);
            break;
        case 'editarstock':
            // Lógica para editar un proveedor
            editarStock($conn);
            break;
        case 'eliminar':
            // Lógica para eliminar un proveedor
            eliminarProductos($conn);
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

function codigoExiste2($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $dataProd = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($dataProd === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "existe" => false, // Cambia "success" a "existe"
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try {
            $codigo = $dataProd["codigo"];
            $sql = "SELECT idProductos FROM Productos WHERE idProductos = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $codigo);

            if (!$stmt->execute()) {
                $response = array(
                    "existe" => false, // Hubo un error al ejecutar la consulta
                    "message" => "Error al ejecutar la consulta"
                );
            } else {
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $stmt->fetch();
                    $stmt->close();
                    $response = array(
                        "existe" => true, // El código existe en la base de datos
                        "message" => "El código existe en la base de datos"
                    );
                } else {
                    $stmt->fetch();
                    $stmt->close();
                    $response = array(
                        "existe" => false, // El código no existe en la base de datos
                        "message" => "El código no existe en la base de datos"
                    );
                }
            }
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            $response = array(
                "existe" => false,
                "error" => $e->getMessage()
            );
        }
    }

    // Devuelve la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

function listarProductos($conn) {
    // Realiza tu consulta SQL para obtener la lista de productos
    $sql = "SELECT P.idProductos, P.Nombre, Pr.Nombre AS Proveedor, TP.Descripcion AS TipoProd, TC.Descripcion AS TipoCat, TT.Abreviatura AS Tamaño, P.Tamaño AS Medida, SUM(SS.Cantidad) AS CantidadTotal, P.PrecioCosto, SS.Impuestos AS Impuesto, SS.PrecioFinal
    FROM Productos P
    INNER JOIN Proveedores Pr ON P.idProveedores = Pr.idProveedores
    INNER JOIN TipoProducto TP ON P.idTipoProducto = TP.idTipoProducto
    INNER JOIN TipoCategoria TC ON P.idTipoCategoria = TC.idTipoCategoria
    INNER JOIN TipoTamaño TT ON P.idTipoTamaño = TT.idTipoTamaño
    INNER JOIN StockSucursales SS ON P.idProductos = SS.idProductos
    GROUP BY P.idProductos, P.Nombre, Pr.Nombre, TP.Descripcion, TC.Descripcion, TT.Abreviatura, P.Tamaño, P.PrecioCosto, SS.Impuestos, SS.PrecioFinal";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $productos = array();
        while ($row = $result->fetch_assoc()) {
            // Agrega cada fila de proveedor a un array
            $productos[] = $row;
        }
        // Genera una respuesta JSON válida utilizando json_encode()
        $response = json_encode($productos);

        // Configura las cabeceras para indicar que se envía JSON
        header("Content-Type: application/json");

        // Envía la respuesta JSON
        echo $response;
    } else {
        // No se encontraron proveedores
        $response = json_encode(array("message" => "No se encontraron productos"));
        header("Content-Type: application/json");
        echo $response;
    }
}
function codigoExiste($conn, $codigo) {
    $sql = "SELECT idProductos FROM Productos WHERE idProductos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo);

    if (!$stmt->execute()) {
        return false; // Hubo un error al ejecutar la consulta
    }

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        $stmt->close();
        return true; // El código existe en la base de datos
        
    } else {
        $stmt->fetch();
        $stmt->close();
        return false; // El código no existe en la base de datos
    }
}

function obtenerProveedorID($conn, $proveedor) {
    $proveedorID = "";
    $sql = "SELECT idProveedores FROM Proveedores WHERE Nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $proveedor);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        $stmt->close(); // Cierra la consulta preparada si no se encontraron resultados
        return false;
    }
    
    $stmt->bind_result($proveedorID);
    $stmt->fetch();
    $stmt->close(); // Cierra la consulta preparada
    
    return $proveedorID;
}

function obtenerCantPorSucursal($conn, $codigo, $sucursalID) {
    $cantidadSucursal = 0;
    $sql = "SELECT Cantidad FROM StockSucursales WHERE IdProductos = ? AND idSucursales = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $codigo, $sucursalID); // Cambiamos "s" por "si" para el segundo parámetro
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        $stmt->close(); // Cierra la consulta preparada si no se encontraron resultados
        return false;
    }
    
    $stmt->bind_result($cantidadSucursal);
    $stmt->fetch();
    $stmt->close(); // Cierra la consulta preparada
    
    return $cantidadSucursal;
}


function obtenerTipoProductoID($conn, $tipoProducto) {
    $tipoProductoID = "";
    $sql = "SELECT idTipoProducto FROM TipoProducto WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoProducto);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        return false;
    }
    
    $stmt->bind_result($tipoProductoID);
    $stmt->fetch();
    $stmt->close();
    
    return $tipoProductoID;
}

function obtenerTipoCategoriaID($conn, $tipoCategoria) {
    $tipoCategoriaID = "";
    $sql = "SELECT idTipoCategoria FROM TipoCategoria WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoCategoria);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        return false;
    }
    
    $stmt->bind_result($tipoCategoriaID);
    $stmt->fetch();
    $stmt->close();
    
    return $tipoCategoriaID;
}

function obtenerTipoTamañoID($conn, $tipoTamaño) {
    $tipoTamañoID = "";
    $sql = "SELECT idTipoTamaño FROM TipoTamaño WHERE Abreviatura = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoTamaño);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        return false;
    }
    
    $stmt->bind_result($tipoTamañoID);
    $stmt->fetch();
    $stmt->close();
    
    return $tipoTamañoID;
}

function obtenerSucursalID($conn, $sucursal) {
    $sucursalID = "";
    $sql = "SELECT idSucursales FROM Sucursales WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sucursal);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        return false;
    }
    
    $stmt->bind_result($sucursalID);
    $stmt->fetch();
    $stmt->close();
    
    return $sucursalID;
}

function validarImpuesto($conn, $impuesto, $porcentajeAumento) {
    $porcentaje = 0;
    if ($impuesto == 1) { // impuesto contiene al iva y a rentas
        $porcentaje = 24.00 + ($porcentajeAumento);
    } else if ($impuesto == 2) { // impuesto contiene al iva
        $porcentaje = 21.00 + ($porcentajeAumento);
    } else if ($impuesto == 3) { // impuesto contiene a rentas
        $porcentaje = 3.00 + ($porcentajeAumento);
    } else { // impuesto es == 0
        $porcentaje = 0.00 + ($porcentajeAumento);
    }
    return $porcentaje;
}
function precioFinal($conn, $precioBase, $porcentajeAumentoTotal) {
    $precioFinal = $precioBase * (1 + ($porcentajeAumentoTotal / 100));
    return $precioFinal;
}

// Función para verificar si el producto ya existe en la sucursal
function productoExisteEnSucursal($conn, $codigo, $sucursalID) {
    $count = 0;
    $sql = "SELECT COUNT(*) FROM StockSucursales WHERE idProductos = ? AND idSucursales = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $codigo, $sucursalID);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count > 0;
}

function insertarProducto($conn, $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño) {
    $sqlProductos = "INSERT INTO Productos (idProductos, idProveedores, idTipoProducto, idTipoCategoria, Nombre, PrecioCosto, idTipoTamaño, Tamaño)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtProductos = $conn->prepare($sqlProductos);
    $stmtProductos->bind_param("siissdss", $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño);

    return $stmtProductos->execute();
}
function insertarStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumentoTotal, $precioFinal) {
    $sqlStock = "INSERT INTO StockSucursales (idSucursales, idProductos, Cantidad, Impuestos, PrecioFinal)
            VALUES (?, ?, ?, ?, ?)";
    $stmtStock = $conn->prepare($sqlStock);
    $stmtStock->bind_param("issdd", $sucursalID, $codigo, $cantidad, $porcentajeAumentoTotal, $precioFinal);

    return $stmtStock->execute();
}

function updateProducto($conn, $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño) {
    $sqlProductos = "UPDATE Productos SET idProveedores = ?, idTipoProducto = ?, idTipoCategoria = ?, Nombre = ?, PrecioCosto = ?, idTipoTamaño = ?, Tamaño = ? WHERE idProductos = ?";
    $stmtProductos = $conn->prepare($sqlProductos);
    $stmtProductos->bind_param("iissdssi", $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño, $codigo);

    return $stmtProductos->execute();
}

function updateStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumentoTotal, $precioFinal) {
    $sqlStock = "UPDATE StockSucursales SET Cantidad = ?, Impuestos = ?, PrecioFinal = ? WHERE idSucursales = ? AND idProductos = ?";
    $stmtStock = $conn->prepare($sqlStock);
    $stmtStock->bind_param("dddis", $cantidad, $porcentajeAumentoTotal, $precioFinal, $sucursalID, $codigo);

    return $stmtStock->execute();
}

function agregarProductos($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosProd = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($datosProd === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try {
            // Los datos JSON se decodificaron correctamente
            // Ahora puedes acceder a los valores individualmente
            $codigo = $datosProd["codigo"];
            $nombre = $datosProd["nombre"];
            $proveedor = $datosProd["proveedor"];
            $tipoProducto = $datosProd["tipoProducto"];
            $tipoCategoria = $datosProd["tipoCategoria"];
            $tamaño = $datosProd["tamaño"];
            $tipoTamaño = $datosProd["tipoTamaño"];
            $cantidad = $datosProd["cantidad"];
            $precioBase = $datosProd["precioBase"];
            $porcentajeAumento = $datosProd["porcentajeAumento"];
            $sucursal = $datosProd["sucursal"];
            $impuesto = $datosProd["impuesto"]; // Si el valor de impuesto es 0, significa que no esta seleccionado ninguno, 
            // si es 1 son ambos impuestos, si es 2 o 3 varia entre iva y rentas.
            $precioFinal = 0;

            // Realiza la inserción en la base de datos (debes adaptar esta parte a tu esquema de base de datos)
            if (codigoExiste($conn, $codigo)) {
                $response = array(
                    "success" => false,
                    "message" => "ingresó un codigo existente." . $conn->error
                );
            } else {
                $proveedorID = obtenerProveedorID($conn, $proveedor);
                $tipoProductoID = obtenerTipoProductoID($conn, $tipoProducto);
                $tipoCategoriaID = obtenerTipoCategoriaID($conn, $tipoCategoria);
                $tipoTamañoID = obtenerTipoTamañoID($conn, $tipoTamaño);
                $sucursalID = obtenerSucursalID($conn, $sucursal);
                $porcentajeAumentoTotal = validarImpuesto($conn, $impuesto, $porcentajeAumento);
                $precioFinal = precioFinal($conn, $precioBase, $porcentajeAumentoTotal);
        
                if (!$proveedorID || !$tipoProductoID || !$tipoCategoriaID || !$tipoTamañoID || !$sucursalID) {
                    $response = array(
                        "success" => false,
                        "message" => "ingresó un dato inválido" . $conn->error
                    );
                } elseif (insertarProducto($conn, $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño)) {
                    if (insertarStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumentoTotal, $precioFinal)) {
                        $response = array(
                            "success" => true,
                            "message" => "Producto agregado con éxito"
                        );
                    } else {
                        $response = array(
                            "success" => false,
                            "message" => "error al agregar el producto" . $conn->error
                        );
                    }
                } else {
                    $response = array(
                        "success" => false,
                        "message" => "error al agregar el producto" . $conn->error
                    );
                }
            }
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    // Envía la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);

}

function eliminarProductos($conn) {
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosProd = json_decode($data, true);
    try {
        $idProductos = $datosProd["id"];

        // Consulta SQL para eliminar el proveedor por su ID
        $sql = "DELETE FROM stocksucursales WHERE idProductos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idProductos);

        $response = array();

        if ($stmt->execute()) {
            // Consulta SQL para eliminar el proveedor por su ID
            $sql = "DELETE FROM productos WHERE idProductos = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idProductos);

            $response = array();

            if ($stmt->execute()) {
                // Eliminación exitosa
                $response = array(
                    "success" => true,
                    "message" => "Producto eliminado con éxito"
                );
            } else {
                // Error en la eliminación
                $response = array(
                    "success" => false,
                    "message" => "Error al eliminar el producto: " . $stmt->error
                );
            }

            // Eliminación exitosa
            $response = array(
                "success" => true,
                "message" => "Producto eliminado con éxito"
            );
        } else {
            // Error en la eliminación
            $response = array(
                "success" => false,
                "message" => "Error al eliminar el producto: " . $stmt->error
            );
        }
    } catch (Exception $e) {
        // Maneja el error, registra información de error si es necesario
        // Devuelve una respuesta HTTP con un código de estado de error
        http_response_code(500); // Código de estado para error interno del servidor
        echo json_encode(array("error" => $e->getMessage()));
    }
    // Envía la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
    
}
function obtenerProductos($conn) {
    // Verifica si se proporcionó un ID válido en la solicitud
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $response = array(
            "success" => false,
            "message" => "ID de producto no válido"
        );
    } else {
        try {
            $idProductos = $_GET['id'];

            // Realiza la consulta SQL para obtener los datos del proveedor por su ID
            $sql = "SELECT 
            P.idProductos, 
            P.Nombre, 
            Pr.Nombre AS Proveedor, 
            TP.Descripcion AS TipoProd, 
            TC.Descripcion AS TipoCat, 
            TT.Abreviatura AS Tamaño, 
            P.Tamaño AS Medida, 
            SS.Cantidad AS CantidadTotal, 
            P.PrecioCosto, 
            SS.Impuestos AS Impuesto, 
            SS.PrecioFinal
            FROM Productos P
            INNER JOIN Proveedores Pr ON P.idProveedores = Pr.idProveedores
            INNER JOIN TipoProducto TP ON P.idTipoProducto = TP.idTipoProducto
            INNER JOIN TipoCategoria TC ON P.idTipoCategoria = TC.idTipoCategoria
            INNER JOIN TipoTamaño TT ON P.idTipoTamaño = TT.idTipoTamaño
            INNER JOIN StockSucursales SS ON P.idProductos = SS.idProductos
            WHERE P.idProductos = ?
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idProductos);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // El proveedor fue encontrado, obtén sus datos
                $producto = $result->fetch_assoc();

                // Genera una respuesta JSON válida utilizando json_encode()
                $response = json_encode($producto);
            } else {
                // No se encontró ningún proveedor con ese ID
                $response = array(
                    "success" => false,
                    "message" => "Producto no encontrado"
                );
            }
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }
        // Configura las cabeceras para indicar que se envía JSON
        header("Content-Type: application/json");
        echo $response;
    }
}

function editarProductos($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosProd = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($datosProd === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try{
            // Los datos JSON se decodificaron correctamente
            // Ahora puedes acceder a los valores individualmente
            // Extrae los datos individuales de $datosProd
            $codigo = $datosProd["codigo"];
            $nombre = $datosProd["nombre"];
            $proveedor = $datosProd["proveedor"];
            $tipoProducto = $datosProd["tipoProducto"];
            $tipoCategoria = $datosProd["tipoCategoria"];
            $tamaño = $datosProd["tamaño"];
            $tipoTamaño = $datosProd["tipoTamaño"];
            $precioBase = $datosProd["precioBase"];
            $porcentajeAumento = $datosProd["porcentajeAumento"];
            $proveedorID = obtenerProveedorID($conn, $proveedor);
            $tipoProductoID = obtenerTipoProductoID($conn, $tipoProducto);
            $tipoCategoriaID = obtenerTipoCategoriaID($conn, $tipoCategoria);
            $tipoTamañoID = obtenerTipoTamañoID($conn, $tipoTamaño);
            $precioFinal = precioFinal($conn, $precioBase, $porcentajeAumento);

            // Consulta SQL para obtener los IDs de los productos que coinciden con el código
            $sqlConsulta = "SELECT idProductos FROM Productos WHERE idProductos = ?";
            $stmtConsulta = $conn->prepare($sqlConsulta);
            $stmtConsulta->bind_param("s", $codigo);
            $stmtConsulta->execute();
            $stmtConsulta->bind_result($codigo);

            // Almacena los IDs de los productos en un array
            $idProductos = array();
            while ($stmtConsulta->fetch()) {
                $idProductos[] = $codigo;
            }
            $stmtConsulta->close();

            $sqlProductos = "UPDATE Productos SET 
                idProveedores = ?, 
                idTipoProducto = ?, 
                idTipoCategoria = ?, 
                Nombre = ?, 
                PrecioCosto = ?, 
                idTipoTamaño = ?, 
                Tamaño = ? 
                WHERE idProductos = ?";
            $stmtProductos = $conn->prepare($sqlProductos);
            $stmtProductos->bind_param("ssssdssi", $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño, $codigo);

            // Consulta SQL para actualizar los registros de StockSucursales
            $sqlStock = "UPDATE StockSucursales SET 
                Impuestos = ?, 
                PrecioFinal = ? 
                WHERE idProductos = ?";
            $stmtStock = $conn->prepare($sqlStock);
            $stmtStock->bind_param("ddi", $porcentajeAumento, $precioFinal, $codigo);

            // Inicia una transacción
            $conn->begin_transaction();

            // Ejecuta las consultas SQL para actualizar los registros
            $actualizacionProductos = $stmtProductos->execute();
            $actualizacionStock = $stmtStock->execute();

            if ($actualizacionProductos && $actualizacionStock) {
                // Si ambas consultas se ejecutaron con éxito, confirma la transacción
                $conn->commit();

                $response = array(
                    "success" => true,
                    "message" => "Registro de producto actualizado correctamente"
                );
            } else {
                // Si alguna consulta falló, realiza un rollback
                $conn->rollback();

                $response = array(
                    "success" => false,
                    "message" => "Error al actualizar el registro de producto"
                );
            }

            // Cierra las consultas
            $stmtProductos->close();
            $stmtStock->close();
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    // Devuelve la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}
function obtenerCantStockPorSucursal($conn) {
    $sql = "SELECT s.idSucursales, s.Descripcion, COUNT(ss.idProductos) as CantidadProductos 
        FROM Sucursales s
        LEFT JOIN StockSucursales ss ON s.idSucursales = ss.idSucursales
        GROUP BY s.idSucursales, s.Descripcion";
    $result = $conn->query($sql);

    $sucursales = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sucursal = array(
                "idSucursales" => $row["idSucursales"],
                "Descripcion" => $row["Descripcion"],
                "CantidadProductos" => $row["CantidadProductos"]
            );
            $sucursales[] = $sucursal;
        }
    } else {
        // No se encontraron sucursales
    }

    $conn->close();

    // Devuelve el resultado como JSON
    header("Content-Type: application/json");
    echo json_encode($sucursales);
}
function obtenerIdSucursal($conn, $nombreSucursal) {
    $idSucursal = 0;
    $sql = "SELECT idSucursales FROM Sucursales WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombreSucursal);
    $stmt->execute();
    $stmt->bind_result($idSucursal);
    $stmt->fetch();
    $stmt->close();
    return $idSucursal;
}

// Función para actualizar la cantidad de stock en la base de datos de manera atómica
function actualizarCantidadStock($conn, $sucursalID, $codigo, $cantidad, $impuesto, $precioFinal) {
    // Iniciar una transacción
    $conn->begin_transaction();

    // Actualizar la cantidad en StockSucursales
    $sql = "UPDATE StockSucursales SET Cantidad = Cantidad + ?, Impuestos = ?, PrecioFinal = ? WHERE idSucursales = ? AND idProductos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dddii", $cantidad, $impuesto, $precioFinal, $sucursalID, $codigo);

    // Realizar la actualización
    $resultado = $stmt->execute();

    // Finalizar la transacción
    if ($resultado) {
        $conn->commit();
    } else {
        $conn->rollback();
    }

    // Cerrar la consulta preparada
    $stmt->close();

    return $resultado;
}

function editarStock($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosProd = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($datosProd === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try {
            // Los datos JSON se decodificaron correctamente
            // Ahora puedes acceder a los valores individualmente
            $codigo = $datosProd["codigo"];
            $cantidad = $datosProd["cantidad"];
            $precioBase = $datosProd["precioBase"];
            $porcentajeAumento = $datosProd["porcentajeAumento"];
            $sucursalNombre = $datosProd["sucursal"]; // Obtiene el nombre de la sucursal desde los datos JSON
            $precioFinal = precioFinal($conn, $precioBase, $porcentajeAumento);

            // Consulta la base de datos para obtener el idSucursales correspondiente al nombre de la sucursal
            $sucursalID = obtenerIdSucursal($conn, $sucursalNombre);

            if ($sucursalID !== false) {
                // Verifica si el producto ya existe en la sucursal
                if (productoExisteEnSucursal($conn, $codigo, $sucursalID)) {
                    if (actualizarCantidadStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumento, $precioFinal)) {
                        $response = array(
                            "success" => true,
                            "message" => "Registro de producto actualizado correctamente"
                        );
                    } else {
                        $response = array(
                            "success" => false,
                            "message" => "Error al actualizar el registro de producto"
                        );
                    }
                } else {
                    if (insertarStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumento, $precioFinal)) {
                        $response = array(
                            "success" => true,
                            "message" => "Registro de producto creado correctamente"
                        );
                    } else {
                        $response = array(
                            "success" => false,
                            "message" => "Error al crear el registro de producto"
                        );
                    }
                }
            } else {
                // La sucursal no se encontró en la base de datos, maneja el error como desees
                $response = array(
                    "success" => false,
                    "message" => "La sucursal no se encontró en la base de datos"
                );
            }
        }
        catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    // Devuelve la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}




?>