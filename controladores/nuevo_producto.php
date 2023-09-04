<?php
include("../bd/conexion.php");

function codigoExiste($conn, $codigo) {
    $sql = "SELECT idProductos FROM Productos WHERE idProductos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $codigo);

    if (!$stmt->execute()) {
        return false; // Hubo un error al ejecutar la consulta
    }

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return true; // El código existe en la base de datos
    } else {
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
        return false;
    }
    
    $stmt->bind_result($proveedorID);
    $stmt->fetch();
    $stmt->close();
    
    return $proveedorID;
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

function validarImpuesto($conn, $porcentajeAumento) {
    $porcentajeAumentoID = "";
    $sql = "SELECT idImpuesto FROM Impuestos WHERE Tasa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $porcentajeAumento);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        return false;
    }
    
    $stmt->bind_result($porcentajeAumentoID);
    $stmt->fetch();
    $stmt->close();
    
    return $porcentajeAumentoID;
}

function precioFinal($conn, $precioBase, $porcentajeAumento) {
    $precioFinal = $precioBase * (1 + ($porcentajeAumento / 100));
    return $precioFinal;
}

function insertarProducto($conn, $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño) {
    $sqlProductos = "INSERT INTO Productos (idProductos, idProveedores, idTipoProducto, idTipoCategoria, Nombre, PrecioCosto, idTipoTamaño, Tamaño)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtProductos = $conn->prepare($sqlProductos);
    $stmtProductos->bind_param("siissdss", $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño);

    return $stmtProductos->execute();
}
function insertarStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumentoID, $precioFinal) {
    $sqlStock = "INSERT INTO StockSucursales (idSucursales, idProductos, Cantidad, idImpuesto, PrecioFinal)
            VALUES (?, ?, ?, ?, ?)";
    $stmtStock = $conn->prepare($sqlStock);
    $stmtStock->bind_param("issdd", $sucursalID, $codigo, $cantidad, $porcentajeAumentoID, $precioFinal);

    return $stmtStock->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $proveedor = $_POST["proveedor"];
    $tipoProducto = $_POST["tipoProducto"];
    $tipoCategoria = $_POST["tipoCategoria"];
    $tamaño = $_POST["tamaño"];
    $tipoTamaño = $_POST["tipoTamaño"];
    $cantidad = $_POST["cantidad"];
    $precioBase = $_POST["precioBase"];
    $porcentajeAumento = $_POST["porcentajeAumento"];
    $sucursal = $_POST["sucursal"];
    
    if (codigoExiste($conn, $codigo)) {
        echo "El código ya existe en el sistema"; // Puedes personalizar este mensaje o usar Toastr
        header("Location: ../vistas/productos.php");
        exit;
    } else {
        $proveedorID = obtenerProveedorID($conn, $proveedor);
        $tipoProductoID = obtenerTipoProductoID($conn, $tipoProducto);
        $tipoCategoriaID = obtenerTipoCategoriaID($conn, $tipoCategoria);
        $tipoTamañoID = obtenerTipoTamañoID($conn, $tipoTamaño);
        $sucursalID = obtenerSucursalID($conn, $sucursal);
        $precioFinal = precioFinal($conn, $precioBase, $porcentajeAumento);
        $porcentajeAumentoID = validarImpuesto($conn, $porcentajeAumento);
        

        if (!$proveedorID || !$tipoProductoID || !$tipoCategoriaID || !$tipoTamañoID || !$sucursalID) {
            // Mostrar error de validación
            echo "error_validacion"; // Puedes manejar esto con Toastr
        } elseif (!validarImpuesto($conn, $porcentajeAumento)) {
            // Mostrar error de impuesto no válido
            echo "error_impuesto"; // Puedes manejar esto con Toastr
        } elseif (insertarProducto($conn, $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño)) {
            if (insertarStock($conn, $sucursalID, $codigo, $cantidad, $porcentajeAumentoID, $precioFinal)) {
                // Producto agregado con éxito, redirigir a productos.php
                $response = array("message" => "success");
                echo json_encode($response);
            } else {
                // Mostrar error al insertar en StockSucursales
                echo "error_stock"; // Puedes manejar esto con Toastr
            }
        } else {
            // Mostrar error al insertar en Productos
            echo "error_productos"; // Puedes manejar esto con Toastr
        }

        $conn->close();
    }
}
?>
