<?php 
include '../bd/conexion.php'; // Incluye el archivo de conexión

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'listar':
            // Lógica para listar usuarios
            listarUsuarios($conn); // Pasa la conexión como parámetro
            break;
        case 'agregar':
            // Lógica para agregar un proveedor
            agregarUsuarios($conn);
            break;
        case 'editar':
            // Lógica para editar un proveedor
            editarUsuarios($conn);
            break;
        case 'eliminar':
            // Lógica para eliminar un proveedor
            eliminarUsuarios($conn);
            break;
        case 'cargarcard':
            // Lógica para listar proveedores
            obtenerCard($conn); // Pasa la conexión como parámetro
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

function agregarUsuarios($conn) {
    
}

function eliminarUsuarios($conn) {
    
}

function editarUsuarios($conn) {
    
}

function listarUsuarios($conn) {
    // Realiza tu consulta SQL para obtener la lista de usuarios
    $sql = "SELECT * FROM tablaUsuarios";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $usuarios = array();
        while ($row = $result->fetch_assoc()) {
            // Agrega cada fila de proveedor a un array
            $usuarios[] = $row;
        }
        // Genera una respuesta JSON válida utilizando json_encode()
        $response = json_encode($usuarios);

        // Configura las cabeceras para indicar que se envía JSON
        header("Content-Type: application/json");

        // Envía la respuesta JSON
        echo $response;
    } else {
        // No se encontraron usuarios
        $response = json_encode(array("message" => "No se encontraron usuarios"));
        header("Content-Type: application/json");
        echo $response;
    }
}

function obtenerCard($conn) {
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



?>