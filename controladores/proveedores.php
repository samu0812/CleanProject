<?php 
include '../bd/conexion.php'; // Incluye el archivo de conexión

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'listar':
            // Lógica para listar proveedores
            listarProveedores($conn); // Pasa la conexión como parámetro
            break;
        case 'agregar':
            // Lógica para agregar un proveedor
            agregarProveedores($conn);
            break;
        case 'obtener':
            obtenerProveedor($conn);
            break;
        case 'editar':
            // Lógica para editar un proveedor
            editarProveedor($conn);
            break;
        case 'eliminar':
            // Lógica para eliminar un proveedor
            eliminarProveedores($conn);
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



function listarProveedores($conn) {
    // Realiza tu consulta SQL para obtener la lista de proveedores
    $sql = "SELECT * FROM proveedores";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $proveedores = array();
        while ($row = $result->fetch_assoc()) {
            // Agrega cada fila de proveedor a un array
            $proveedores[] = $row;
        }
        // Genera una respuesta JSON válida utilizando json_encode()
        $response = json_encode($proveedores);

        // Configura las cabeceras para indicar que se envía JSON
        header("Content-Type: application/json");

        // Envía la respuesta JSON
        echo $response;
    } else {
        // No se encontraron proveedores
        $response = json_encode(array("message" => "No se encontraron proveedores"));
        header("Content-Type: application/json");
        echo $response;
    }
}

function agregarProveedores($conn) {

    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");

    // Decodifica los datos JSON en un array asociativo
    $datosProveedor = json_decode($data, true);

    // Verifica si se pudo decodificar correctamente
    if ($datosProveedor === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        // Los datos JSON se decodificaron correctamente
        // Ahora puedes acceder a los valores individualmente
        $cuit = $datosProveedor["cuit"];
        $nombre = $datosProveedor["nombre"];
        $domicilio = $datosProveedor["domicilio"];
        $telefono = $datosProveedor["telefono"];
        $email = $datosProveedor["email"];
        $ciudad = $datosProveedor["ciudad"];
        $razonSocial = $datosProveedor["razonSocial"];

        // Realiza la inserción en la base de datos (debes adaptar esta parte a tu esquema de base de datos)
        $sql = "INSERT INTO proveedores (cuit, nombre, domicilio, telefono, email, ciudad, razonSocial) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $cuit, $nombre, $domicilio, $telefono, $email, $ciudad, $razonSocial);

        if ($stmt->execute()) {
            // Inserción exitosa
            $response = array(
                "success" => true,
                "message" => "Proveedor agregado con éxito"
            );
        } else {
            // Error en la inserción
            $response = array(
                "success" => false,
                "message" => "Error al agregar el proveedor: " . $conn->error
            );
        }
    }

    // Envía la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);

}

function eliminarProveedores($conn) {
    $data = file_get_contents("php://input");

    // Decodifica los datos JSON en un array asociativo
    $datosProveedor = json_decode($data, true);

    $idProveedor = $datosProveedor["idDelProveedor"];

    // Consulta SQL para eliminar el proveedor por su ID
    $sql = "DELETE FROM proveedores WHERE idProveedores = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProveedor);

    $response = array();

    if ($stmt->execute()) {
        // Eliminación exitosa
        $response = array(
            "success" => true,
            "message" => "Proveedor eliminado con éxito"
        );
    } else {
        // Error en la eliminación
        $response = array(
            "success" => false,
            "message" => "Error al eliminar el proveedor: " . $stmt->error
        );
    }

    // Envía la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
    
}

function obtenerProveedor($conn) {
    // Verifica si se proporcionó un ID válido en la solicitud
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $response = array(
            "success" => false,
            "message" => "ID de proveedor no válido"
        );
    } else {
        $idProveedor = $_GET['id'];

        // Realiza la consulta SQL para obtener los datos del proveedor por su ID
        $sql = "SELECT * FROM proveedores WHERE idProveedores = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idProveedor);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // El proveedor fue encontrado, obtén sus datos
            $proveedor = $result->fetch_assoc();

            // Genera una respuesta JSON válida utilizando json_encode()
            $response = json_encode($proveedor);
        } else {
            // No se encontró ningún proveedor con ese ID
            $response = array(
                "success" => false,
                "message" => "Proveedor no encontrado"
            );
        }

        // Configura las cabeceras para indicar que se envía JSON
        header("Content-Type: application/json");
        echo $response;
    }
}

function editarProveedor($conn){
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");

    // Decodifica los datos JSON en un array asociativo
    $datosProveedor = json_decode($data, true);

    // Verifica si se pudo decodificar correctamente
    if ($datosProveedor === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        // Los datos JSON se decodificaron correctamente
        // Ahora puedes acceder a los valores individualmente
        $proveedorId = $datosProveedor["ProveedorId"];
        $cuit = $datosProveedor["Cuit"];
        $nombre = $datosProveedor["Nombre"];
        $domicilio = $datosProveedor["Domicilio"];
        $telefono = $datosProveedor["Telefono"];
        $email = $datosProveedor["Email"];
        $ciudad = $datosProveedor["Ciudad"];
        $razonSocial = $datosProveedor["RazonSocial"];

        // Realiza la actualización en la base de datos
        $sql = "UPDATE proveedores SET
            Cuit = ?,
            Nombre = ?,
            Domicilio = ?,
            Telefono = ?,
            Email = ?,
            Ciudad = ?,
            RazonSocial = ?
            WHERE idProveedores = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $cuit, $nombre, $domicilio, $telefono, $email, $ciudad, $razonSocial, $proveedorId);


        if ($stmt->execute()) {
            $response = array(
                "success" => true,
                "message" => "Registro de proveedor actualizado correctamente"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "Error al actualizar el registro de proveedor"
            );
        }
    }

    // Devuelve la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

?>