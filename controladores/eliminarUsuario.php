<?php
include '../bd/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $personaID = $_POST['idPersonaEliminar'];
    if (isset($_POST['eliminar']) && isset($_POST['idPersonaEliminar'])) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // Llamar al procedimiento almacenado
            $stmt = $conn->prepare("CALL EliminarPersonaYGuardarEnUsuariosEliminados(:personaID)");
            $stmt->bindParam(':personaID', $personaID, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: ../vistas/usuarios.php");
            exit; // Asegúrate de usar exit después de la redirección para detener la ejecución del script actual



        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>
