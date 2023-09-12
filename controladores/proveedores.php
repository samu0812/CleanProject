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
        case 'editar':
            // Lógica para editar un proveedor
            break;
        case 'eliminar':
            // Lógica para eliminar un proveedor
            break;
        default:
            // Acción no válida
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
?>