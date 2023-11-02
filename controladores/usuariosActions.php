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
        case 'obtener':
            // Lógica para listar proveedores
            obtenerUsuario($conn); // Pasa la conexión como parámetro
            break;
        case 'verificaremail':
            // Lógica para listar proveedores
            verificarEmail($conn); // Pasa la conexión como parámetro
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

function obtenerRol($conn, $rol) {
    $rolId = "";
    $sql = "SELECT idRol FROM Rol WHERE Descripcion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rol);
    
    if (!$stmt->execute()) {
        return false;
    }
    
    $stmt->store_result();
    
    if ($stmt->num_rows == 0) {
        return false;
    }
    
    $stmt->bind_result($rolId);
    $stmt->fetch();
    $stmt->close();
    
    return $rolId;
}

function obtenerSurcusal($conn, $sucursal) {
    $sucursalId = "";
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
    
    $stmt->bind_result($sucursalId);
    $stmt->fetch();
    $stmt->close();
    
    return $sucursalId;
}

function agregarUsuarios($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosUsuarios = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($datosUsuarios === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try {
            // Los datos JSON se decodificaron correctamente
            $nombre = $datosUsuarios["nombre"];
            $email = $datosUsuarios["email"];
            $telefono = $datosUsuarios["telefono"];
            $direccion = $datosUsuarios["direccion"];
            $fechanacimiento = $datosUsuarios["fechanacimiento"];
            $rol = $datosUsuarios["rol"];
            $sucursal = $datosUsuarios["sucursal"];
            $clave = $datosUsuarios["clave"];
            $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
            $rolId = obtenerRol($conn, $rol);

            // Realiza una consulta SQL para verificar si el email ya existe en la base de datos
            $sql = "SELECT COUNT(*) AS count FROM Persona WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email); // "s" indica que es una cadena (string)
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $count = $row["count"];
                if ($count > 0) {
                    $response = array(
                        "success" => false,
                        "message" => "el email ingresado ya existe." . $conn->error
                    );
                } else {
                    $sqlusuario = "INSERT INTO Persona (Nombre, Email, Telefono, Direccion, FechaNacimiento) VALUES (?, ?, ?, ?, ?)";
                    $stmtUsuario = $conn->prepare($sqlusuario);
                    $stmtUsuario->bind_param("sssss", $nombre, $email, $telefono, $direccion, $fechanacimiento);

                    if ($stmtUsuario->execute()) {
                        $idPersona = mysqli_insert_id($conn);
                        $sqlEmpleado = "INSERT INTO Empleado (idSucursales, idPersona, idRol, Clave) VALUES (?, ?, ?, ?)";
                        $stmtEmpleado = $conn->prepare($sqlEmpleado);
                        $stmtEmpleado->bind_param("iiis", $sucursal, $idPersona, $rolId, $hashedClave);
                        
                        if ($stmtEmpleado->execute()) {
                            $response = array(
                                "success" => true,
                                "message" => "Usuario agregado con éxito"
                            );
                        } else {
                            $response = array(
                                "success" => false,
                                "message" => "error al agregar el usuario" . $conn->error
                            );
                        }
                    } else {
                        $response = array(
                            "success" => false,
                            "message" => "error al agregar el empleado" . $conn->error
                        );
                    }
                }
            } else {
                $response = json_encode(array("message" => "Error"));
                header("Content-Type: application/json");
                echo $response;
            }

            $stmt->close();
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }
    }
    // Envía la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

function verificarEmail ($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosUsuario = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($datosUsuario === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "existe" => false, // Cambia "success" a "existe"
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try {
            $email = $datosUsuario["email"];
            $sql = "SELECT COUNT(*) AS count FROM Persona WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email); // "s" indica que es una cadena (string)
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $count = $row["count"];
                if ($count > 0) {
                    $response = array(
                        "success" => false,
                        "message" => "el email ingresado ya existe." . $conn->error
                    );
                } else {
                    $response = array(
                        "success" => true,
                        "message" => "Prosiga" . $conn->error
                    );
                }
            }
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            $response = array(
                "success" => false,
                "error" => $e->getMessage()
            );
        }
    }

    // Devuelve la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

function eliminarUsuarios($conn) {
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosUsuarios = json_decode($data, true);
    try {
        $idPersona = $datosUsuarios["id"];
        // Luego, ejecuta el procedimiento almacenado
        $idPersonaINT = (int)$idPersona;
        $sqlProcedimiento = "CALL EliminarPersonaYGuardarEnUsuariosEliminados(?)"; // Ajusta el nombre y los parámetros según tu procedimiento
        $stmtProcedimiento = $conn->prepare($sqlProcedimiento);
        $stmtProcedimiento->bind_param("i", $idPersonaINT);
        $response = array();

        if ($stmtProcedimiento->execute()) {
            $response = array(
                "success" => true,
                "message" => "Se eliminó correctamente el usuario." . $stmtProcedimiento->error
            );
        } else {
            // Error al ejecutar el procedimiento almacenado
            $response = array(
                "success" => false,
                "message" => "Error al ejecutar el procedimiento almacenado: " . $stmtProcedimiento->error
            );
        }
    } catch (Exception $e) {
        // Maneja el error, registra información de error si es necesario
        // Devuelve una respuesta HTTP con un código de estado de error
        http_response_code(500); // Código de estado para error interno del servidor
        echo json_encode(array("error" => $e->getMessage()));
    }
    // Envía la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

function editarUsuarios($conn) {
    // Obtiene el cuerpo de la solicitud
    $data = file_get_contents("php://input");
    // Decodifica los datos JSON en un array asociativo
    $datosUsuario = json_decode($data, true);
    // Verifica si se pudo decodificar correctamente
    if ($datosUsuario === null) {
        // Hubo un error al decodificar los datos JSON
        $response = array(
            "success" => false,
            "message" => "Error en los datos JSON recibidos"
        );
    } else {
        try{
            $idPersona = $datosUsuario["codigo"];
            $nombre = $datosUsuario["nombre"];
            $email = $datosUsuario["email"];
            $telefono = $datosUsuario["telefono"];
            $direccion = $datosUsuario["direccion"];
            $fechanacimiento = $datosUsuario["fechanacimiento"];
            $rol = $datosUsuario["rol"];
            $sucursal = $datosUsuario["sucursal"];
            $clave = $datosUsuario["clave"];
            $hashedClave = password_hash($clave, PASSWORD_DEFAULT);
            $rolId = obtenerRol($conn, $rol);

            $sqlUpdatePersona = "UPDATE Persona SET Nombre = ?, Email = ?, Telefono = ?, Direccion = ?, FechaNacimiento = ? WHERE idPersona = ?";
            $stmtUpdatePersona = $conn->prepare($sqlUpdatePersona);
            $stmtUpdatePersona->bind_param("sssssi", $nombre, $email, $telefono, $direccion, $fechanacimiento, $idPersona);

            if ($stmtUpdatePersona->execute()) {
                // Actualización de Persona exitosa, ahora actualiza Empleado (si es necesario)
                $sqlUpdateEmpleado = "UPDATE Empleado SET idSucursales = ?, idRol = ?, Clave = ? WHERE idPersona = ?";
                $stmtUpdateEmpleado = $conn->prepare($sqlUpdateEmpleado);
                $stmtUpdateEmpleado->bind_param("iisi", $sucursal, $rolId, $hashedClave, $idPersona);

                if ($stmtUpdateEmpleado->execute()) {
                    $response = array(
                        "success" => true,
                        "message" => "se ejecutó correctamente la actualización"
                    );
                } else {
                    $response = array(
                        "success" => false,
                        "message" => "no se pudo actualizar el empleado." . $conn->error
                    );
                }
            } else {
                $response = array(
                    "success" => false,
                    "message" => "no se pudo actualizar el usuario." . $conn->error
                );
            }
            $stmtUpdatePersona->close();
            $stmtUpdateEmpleado->close();
        } catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }
    }

    // Devuelve la respuesta como JSON
    header("Content-Type: application/json");
    echo json_encode($response);
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
    $query = "SELECT COUNT(*) AS count FROM Empleado";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row["count"];
        $response = json_encode($count);
        header("Content-Type: application/json");
        echo $response;
    } else {
        $response = json_encode(0);;
        header("Content-Type: application/json");
        echo $response;
    }
}

function obtenerUsuario($conn) {
    // Verifica si se proporcionó un ID válido en la solicitud
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        $response = array(
            "success" => false,
            "message" => "ID de proveedor no válido"
        );
    } else {

        try {
            $idUsuario = $_GET['id'];
            // Realiza la consulta SQL para obtener los datos del proveedor por su ID
            $sql = "SELECT 
                `p`.`idPersona` AS `idPersona`,
                `p`.`Nombre` AS `Nombre`,
                `p`.`Email` AS `Email`,
                `p`.`Telefono` AS `Telefono`,
                `p`.`Direccion` AS `Direccion`,
                `p`.`FechaNacimiento` AS `FechaNacimiento`,
                `e`.`Clave` AS `Clave`,
                `r`.`Descripcion` AS `Rol`,
                `s`.`Descripcion` AS `Sucursal`
            FROM
                (((`clean`.`persona` `p`
                JOIN `clean`.`empleado` `e` ON ((`p`.`idPersona` = `e`.`idPersona`)))
                JOIN `clean`.`rol` `r` ON ((`e`.`IdRol` = `r`.`idRol`)))
                JOIN `clean`.`sucursales` `s` ON ((`e`.`idSucursales` = `s`.`idSucursales`)))
            WHERE
                `p`.`idPersona` = ?; -- Aquí pasas el idPersona deseado como parámetro
            ";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // El proveedor fue encontrado, obtén sus datos
                $usuario = $result->fetch_assoc();

                // Genera una respuesta JSON válida utilizando json_encode()
                $response = json_encode($usuario);
            } else {
                // No se encontró ningún proveedor con ese ID
                $response = array(
                    "success" => false,
                    "message" => "Usuario no encontrado"
                );
            }

        }
        // Si hay un error, lanza una excepción
        catch (Exception $e) {
            // Maneja el error, registra información de error si es necesario
            // Devuelve una respuesta HTTP con un código de estado de error
            http_response_code(500); // Código de estado para error interno del servidor
            echo json_encode(array("error" => $e->getMessage()));
        }

        // Configura las cabeceras para indicar que se envía JSON
        header("Content-Type: application/json");
        echo $response;
    }
}

?>