<?php
include '../bd/conexion.php';

$response = array();

if (isset($_POST['id']) && isset($_POST['opcion']) && isset($_POST['descripcion']) && isset($_POST['abreviatura'])) {
    $id = $_POST['id'];
    $opcion = $_POST['opcion'];
    $descripcion = $_POST['descripcion'];
    $abreviatura = $_POST['abreviatura'];

    // Consulta SQL para actualizar el elemento según su ID y la opción seleccionada
    $query = "";

    switch ($opcion) {
        case 'rol':
            $query = "UPDATE rol SET descripcion = '$descripcion' WHERE idRol = $id";
            break;
        case 'sucursal':
            $query = "UPDATE sucursal SET descripcion = '$descripcion' WHERE idSucursales = $id";
            break;
        case 'tipoproducto':
            $query = "UPDATE tipoproducto SET descripcion = '$descripcion' WHERE idTipoProducto = $id";
            break;
        case 'tipotamaño':
            $query = "UPDATE tipoproducto SET descripcion = '$descripcion' AND SET abreviatura='$abreviatura' WHERE idTipotamaño = $id";
            break;    
        case 'tipocategoria':
            $query = "UPDATE tipocategoria  SET descripcion = '$descripcion' WHERE idTipoCategoria = $id";
            break;
        case 'formadepago':
            $query = "UPDATE formadepago  SET descripcion = '$descripcion' WHERE idFormaDePago = $id";
            break;
        case 'tipodedocumento':
            $query = "UPDATE tipoFactura  SET descripcion = '$descripcion' WHERE idTipoFactura = $id";
            break;        
        // Agrega casos para otras opciones según tu estructura de base de datos
        default:
            break;
    }

    if (!empty($query)) {
        if ($conn->query($query) === TRUE) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

// Cierra la conexión a la base de datos
$conn->close();

// Devuelve la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
