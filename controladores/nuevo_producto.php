<?php
include("../bd/conexion.php");

echo "ceci entró al archivo";

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
    $precioVenta = 0;
    $sucursal = $_POST["sucursal"];

    // OBTENER EL PROVEEDOR
    $sql = "SELECT idProveedores FROM Proveedores WHERE Nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $proveedor);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        echo "El proveedor '$proveedor' no existe en la tabla de Proveedores.";
        exit;
    }
    $stmt->bind_result($proveedorID);
    if (!$stmt->fetch()) {
        echo "Error al obtener el ID del proveedor: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // OBTENER EL TIPO PRODUCTO
    $sql = "SELECT idTipoProducto FROM TipoProducto WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoProducto);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        echo "El tipo de producto '$tipoProducto' no existe en la tabla de TipoProducto.";
        exit;
    }
    $stmt->bind_result($tipoProductoID);
    if (!$stmt->fetch()) {
        echo "Error al obtener el ID del tipo de producto: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // OBTENER EL TIPO CATEGORIA
    $sql = "SELECT idTipoCategoria FROM TipoCategoria WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoCategoria);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        echo "El tipo de categoría '$tipoCategoria' no existe en la tabla de TipoCategoria.";
        exit;
    }
    $stmt->bind_result($tipoCategoriaID);
    if (!$stmt->fetch()) {
        echo "Error al obtener el ID del tipo de categoría: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // OBTENER EL TIPO TAMAÑO
    $sql = "SELECT idTipoTamaño FROM TipoTamaño WHERE Abreviatura = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tipoTamaño);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        echo "El tipo de tamaño '$tipoTamaño' no existe en la tabla de TipoTamaño.";
        exit;
    }
    $stmt->bind_result($tipoTamañoID);
    if (!$stmt->fetch()) {
        echo "Error al obtener el ID del tipo de tamaño: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // OBTENER LA SUCURSAL
    $sql = "SELECT idSucursales FROM Sucursales WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sucursal);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        echo "La sucursal '$sucursal' no existe en la tabla de Sucursales.";
        exit;
    }
    $stmt->bind_result($sucursalID);
    if (!$stmt->fetch()) {
        echo "Error al obtener el ID de la sucursal: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Verificar si la tasa de impuestos existe en la tabla Impuestos
    $sql = "SELECT idImpuesto FROM Impuestos WHERE Tasa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("d", $porcentajeAumento);
    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        exit;
    }
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        echo "La tasa de impuestos '$porcentajeAumento' no existe en la tabla de Impuestos.";
        exit;
    }
    $stmt->bind_result($porcentajeAumentoID);
    if (!$stmt->fetch()) {
        echo "Error al obtener el ID de la tasa de impuestos: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Calcular el precio final con la tasa de impuestos
    $precioVenta = $precioBase * (1 + ($porcentajeAumento / 100));
    
    // Insertar el nuevo producto en la tabla Productos
    $sqlProductos = "INSERT INTO Productos (idProductos, idProveedores, idTipoProducto, idTipoCategoria, Nombre, PrecioCosto, idTipoTamaño, Tamaño)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtProductos = $conn->prepare($sqlProductos);
    $stmtProductos->bind_param("siissdss", $codigo, $proveedorID, $tipoProductoID, $tipoCategoriaID, $nombre, $precioBase, $tipoTamañoID, $tamaño);

    if ($stmtProductos->execute()) {
        // Preparar una nueva sentencia para insertar en StockSucursales
        $sqlStock = "INSERT INTO StockSucursales (idSucursales, idProductos, Cantidad, idImpuesto, PrecioFinal)
                VALUES (?, ?, ?, ?, ?)";
        $stmtStock = $conn->prepare($sqlStock);
        $stmtStock->bind_param("issdd", $sucursalID, $codigo, $cantidad, $porcentajeAumentoID, $precioVenta);
    
        if ($stmtStock->execute()) {
            echo "Producto agregado con éxito.";
        } else {
            echo "Error al agregar el producto en StockSucursales: " . $stmtStock->error;
        }
    
        $stmtStock->close(); // Cerrar la sentencia de StockSucursales
    } else {
        echo "Error al agregar el producto en Productos: " . $stmtProductos->error;
    }

    // Cerrar la conexión
    $stmtProductos->close();
    $conn->close();
}
?>
