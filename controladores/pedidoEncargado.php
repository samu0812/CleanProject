<?php
// Conecta a la base de datos (reemplaza las credenciales según tu configuración)
include ("../bd/conexion.php");

// Verifica la conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

// Obtiene los datos JSON enviados desde JavaScript
$data = json_decode(file_get_contents('php://input'), true);

// Verifica que los datos necesarios se hayan recibido
if (isset($data['sucursal']) && isset($data['nuevoEstado'])) {
    $sucursal = $data['sucursal'];
    $nuevoEstado = $data['nuevoEstado'];

    // Verifica el valor de $sucursal y actualiza el estado en consecuencia

    if ($sucursal === "Eva Peron") {
        $idSucursal = 3;
    } elseif ($sucursal === "Nestor Kirchner") {
        $idSucursal = 2;
    }

    // Actualiza el estado del pedido en la base de datos
    $sql = "UPDATE pedidossucursales SET estado = ? WHERE idSucursales = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nuevoEstado, $idSucursal);

    if ($stmt->execute()) {
        // La actualización fue exitosa
        $response = array('success' => true, 'message' => 'Estado actualizado con éxito');
        echo json_encode($response);
    } else {
        // Hubo un error en la actualización
        $response = array('success' => false, 'message' => 'Error al actualizar el estado');
        echo json_encode($response);
    }

    // Cierra la conexión
    $stmt->close();
    $mysqli->close();
} else {
    // Datos insuficientes
    $response = array('success' => false, 'message' => 'Datos insuficientes');
    echo json_encode($response);
}
?>