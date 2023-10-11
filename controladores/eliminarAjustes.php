<?php
include '../bd/conexion.php';

$response = array();

if (isset($_POST['id']) && isset($_POST['opcion'])) {
    $id = $_POST['id'];
    $opcion = $_POST['opcion'];

    // Consulta SQL para eliminar el elemento según su ID y la opción seleccionada
    $query = "";

    switch ($opcion) {
        case 'rol':
            if($id != 1){
            $query = "DELETE FROM rol WHERE idRol = $id";
            break;
        }else{
            $response['success'] = false;
        };
        case 'sucursal':
            if($id != 1){
            $query = "DELETE FROM sucursales WHERE idSucursales = $id";
            break;
            }else{
                $response['success'] = false;  
            };
        case 'tipoproducto':
            $query = "DELETE FROM tipoproducto WHERE idTipoProducto = $id";
            break;
        // Agrega casos para otras opciones según tu estructura de base de datos
        case 'tipocategoria':
            $query = "DELETE FROM tipocategoria WHERE idTipocategoria = $id";
            break;
        case 'tipotamaño':
            $query = "DELETE FROM tipotamaño WHERE idTipotamaño = $id";
            break;
        case 'formadepago':
            $query = "DELETE FROM formadepago WHERE idFormaDePago = $id";
            break;
        case 'tipodedocumento':
            $query = "DELETE FROM tipoFactura WHERE idTipoFactura = $id";
            break;    
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
