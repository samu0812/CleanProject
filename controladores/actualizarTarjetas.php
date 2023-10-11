<?php
include '../bd/conexion.php';

$response = array();

// Consulta para obtener la cantidad de registros en la tabla 'rol'
$queryRol = "SELECT COUNT(idRol) AS count FROM rol";
$resultRol = $conn->query($queryRol);

if ($resultRol->num_rows > 0) {
    $rowRol = $resultRol->fetch_assoc();
    $response['rol'] = $rowRol["count"];
} else {
    $response['rol'] = 0;
}

// Consulta para obtener la cantidad de registros en la tabla 'sucursales'
$querySucursales = "SELECT COUNT(idSucursales) AS count FROM sucursales";
$resultSucursales = $conn->query($querySucursales);

if ($resultSucursales->num_rows > 0) {
    $rowSucursales = $resultSucursales->fetch_assoc();
    $response['sucursal'] = $rowSucursales["count"];
} else {
    $response['sucursal'] = 0;
}

$querytipoProductos = "SELECT COUNT(idTipoProducto) AS count
FROM tipoproducto;";
$resultProductos = $conn->query($querytipoProductos);

if ($resultProductos->num_rows > 0) {
    $rowProductos = $resultProductos->fetch_assoc();
    $response['tipoproducto'] = $rowProductos["count"];
} else {
    $response['tipoproducto'] = 0;
}
$queryCategoria = "SELECT COUNT(idtipocategoria) AS count FROM tipocategoria";
$resultCategoria = $conn->query($queryCategoria);

if ($resultCategoria->num_rows > 0) {
    $rowCategoria = $resultCategoria->fetch_assoc();
    $response['categoria'] = $rowCategoria["count"];
} else {
    $response['categoria'] = 0;
}

// Consulta para obtener la cantidad de registros en la tabla 'tipoTamaño'
$queryTamaño = "SELECT COUNT(idTipoTamaño) AS count FROM tipoTamaño";
$resultTamaño = $conn->query($queryTamaño);

if ($resultTamaño->num_rows > 0) {
    $rowTamaño = $resultTamaño->fetch_assoc();
    $response['tamaño'] = $rowTamaño["count"];
} else {
    $response['tamaño'] = 0;
}

$queryFactura = "SELECT COUNT(idtipofactura) AS count FROM tipofactura";
$resultFactura = $conn->query($queryFactura);

if ($resultFactura->num_rows > 0) {
    $rowFactura = $resultFactura->fetch_assoc();
    $response['factura'] = $rowFactura["count"];
} else {
    $response['factura'] = 0;
}

$querypago = "SELECT COUNT(idformadepago) AS count FROM formadepago";
$resultpago = $conn->query($querypago);

if ($resultpago->num_rows > 0) {
    $rowpago = $resultpago ->fetch_assoc();
    $response['formadepago'] = $rowpago ["count"];
} else {
    $response['formadepago'] = 0;
}

// Repite el proceso para obtener datos de otras tarjetas
// ...

// Cierra la conexión a la base de datos
$conn->close();

// Devuelve los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
