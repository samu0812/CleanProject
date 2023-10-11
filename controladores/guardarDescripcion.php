<?php
// ... Tu código anterior ...

// Verificar si se ha enviado una solicitud POST para guardar un nuevo dato
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opcion']) && isset($_POST['descripcion'])) {
    // Conexión a la base de datos (debes proporcionar tus propios datos de conexión)
    include '../bd/conexion.php';

    $opcion = $_POST['opcion'];
    $descripcion = $_POST['descripcion'];

    // Realizar la inserción en la tabla correspondiente según la opción
    switch ($opcion) {
        case 'rol':
            $query = "INSERT INTO rol (Descripcion) VALUES (?)";
            break;
        case 'sucursal':
            $query = "INSERT INTO sucursales (Descripcion) VALUES (?)";
            break;
        case 'tipoproducto':
            $query = "INSERT INTO tipoproducto (Descripcion) VALUES (?)";
            break;
        case 'tipocategoria':
            $query = "INSERT INTO tipocategoria (Descripcion) VALUES (?)";
            break;
        case 'tipotamaño':
            $query = "INSERT INTO tipotamaño (Descripcion, Abreviatura) VALUES (?, ?)";
            // Si tienes un campo Abreviatura en la tabla tipotamaño, asegúrate de proporcionar el valor correspondiente
            $abreviatura = $_POST['abreviatura']; // Asegúrate de ajustar el nombre del campo si es diferente en tu base de datos
            break;
        case 'formadepago':
            $query = "INSERT INTO formadepago (Descripcion) VALUES (?)";
            break;
        case 'tipodedocumento':
            $query = "INSERT INTO tipoFactura (Descripcion) VALUES (?)";
            break;    
        default:
            // Manejar caso no válido o desconocido
            echo json_encode(array('success' => false));
            exit; // Salir del script
    }

    // Preparar la declaración SQL
    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Bind de parámetros y ejecución de la consulta
        if ($opcion === 'tipotamaño') {
            $stmt->bind_param('ss', $descripcion, $abreviatura);
        } else {
            $stmt->bind_param('s', $descripcion);
        }

        if ($stmt->execute()) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(array('success' => false));
    }

    exit; // Salir del script después de la inserción
}
?>
